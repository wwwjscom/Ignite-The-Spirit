/******************************************************************************
 Lightloader
 Copyright (C) 2007  Jeremy Nicoll

 This library is free software; you can redistribute it and/or
 modify it under the terms of the GNU Lesser General Public
 License as published by the Free Software Foundation; either
 version 2.1 of the License, or (at your option) any later version.

 This library is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public
 License along with this library; if not, write to the Free Software
 Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA

 Please see lgpl.txt for a copy of the license - this notice and the file
 lgpl.txt must accompany this code.

 Please go to forums.SeeMySites.net for questions and support of this library.
 Go to www.ScriptSing.com for code updates.
*******************************************************************************/

function LightLoader(field_name, attach_to, cgi_uploader, progress_checker) {
  var i;
  var body = document.get_body();
  var self = this;
  
  progress_checker = progress_checker || 'progress.php';
  progress_checker = progress_checker + (progress_checker.match(/\?/) ? '&' : '?') + new Date().getTime();
  this.field_name = field_name;
  if (attach_to instanceof String) {this.attach_to = $s(attach_to);}
  else {this.attach_to = attach_to;}

  if (!this.attach_to || !this.attach_to.tagName ||this.attach_to.tagName.toLowerCase() != 'form') {
    alert('You need to attach LightLoader to a form.');
    return;
  }

  if (!this.attach_to.max_index) {this.attach_to.max_index = 0;}
  this.index = this.attach_to.max_index;
  this.attach_to.max_index++;

  if (!this.container) {
    this.container = ss._('div');
    var s = this.container.style;
    s.top = s.left = 0;
    s.position = 'absolute';
    s.height = s.width = '1px';
    s.visibility = 'hidden';
    body.appendChild(this.container);
  }

  this.id = ss.rand_id(60);
  while(this.all_by_id[this.id]) {this.id = ss.rand_id(60);}

  // Create the uploader form and iFrame for loading outside of a "real" submit.
  this.form = document.createElement('form');
  this.form.className = 'uploader_form';

  this.form.name = 'upload_form_' + this.id;
  this.form.id = this.form.name;
  this.form.action = cgi_uploader + '?id=' + escape(this.id);
  this.form.enctype = this.form.encoding = 'multipart/form-data';
  this.form.method = 'post';
  this.container.appendChild(this.form);

  var div = ss._('div');
  var nameid = 'upload_frame_'+this.id;
  div.innerHTML  = '<iframe name="'+ nameid + '" id="' +nameid +'" src="about:blank"><'+'/iframe>';
  this.container.appendChild(div);

  this.form.target = nameid;
  this.iframe = document.$s(nameid);

  this.uploading = false;
  this.uploaded = false;
  this.already_uploaded = false;
  
  this.requester = new RepeatRequest(progress_checker, {'id' : this.id}, 1500);
  this.requester.send_method = 'post';
  this.requester.success_function = function(obj) {
  	if (obj.error) {
  	  self.send_error(obj.error, self.id);
  	} else {
	  if (obj.type) {
	    self.finish_uploading(obj);
	  } else {
	    self.update_progress(obj);
	   }
	}
  };
  this.requester.fail_function = function(obj) {
  	self.send_error(obj.msg, self.id);
  };

  this.all[this.all.length] = this;
  this.all_by_id[this.id] = this;

  this.init();
}


LightLoader.prototype = {
  set_file_input : function(input) {
    if (input instanceof String) {input = $s(input);}
    this.input = input;
    this.input.id = this.form.name + '_upload'
    this.input.name = this.input.id;
    this.input.onchange = this.upload;
    this.input.ll_obj = this.id;  // For easier referencing later on.
  },

  set_progress_bar : function(progress) {
    if (progress instanceof String) {progress = document.getElementById(progress);}
    this.progress_bar = progress;
  },

  update_progress : function(info) {
    this.progress_bar.update_progress(info);
  },

  all : [],
  all_by_id : {},
  vars: ['name', 'type', 'tmp_name', 'size', 'field_name', 'index'],
  container : false,

  /*************************************
   *To be used by user for all instances
   *************************************/
  get_by_id : function(str) {
    return this.all_by_id[str] ? this.all_by_id[str] : false;
  },
  
  remove : function(id) {
  	if (this.all_by_id[id]) {
  	  this.all_by_id[id] = undefined;
  	  var found = false
  	  for (var i=0; i < this.all.length; i++) {
  	    if (found) {
  		  this.all[i].index = i;
  		} else if (this.all[i].id == id) {
  		  this.all.splice(i, 1);
  		  i--;
  		  found = true;
  		}
  	  }
  	}
  },

  still_uploading : function() {
    var yes = false;  // I don't know why I get a kick out of this variable name.
    for (var i=0; i < this.all.length; i++) {
      if (this.all[i].uploading) {
        yes = true;
        break;
      }
    }
    return yes;
  },

  init : function() {
    ss.add_listener(this.attach_to, 'submit', this.on_form_submit);
    this.onload = function(){};
  },

  clear_vars : function() {
    for (var i=0; i < this.vars.length; i++) {
      switch (this.vars[i]) {
        case 'field_name':  case 'index': continue;
        default:
          this[this.vars[i]] = false;
      }
    }
  },

  /***************************************
   * To be used by the objects themselves
   ***************************************/
  upload : function() {
    // This function is called in context of the uploading file element.
    // this = input.file
    // Reset upload stuff
    var ll_obj = LightLoader.prototype.get_by_id(this.ll_obj);
    ll_obj.clear_vars();
    new_input = this.cloneNode(true);
    new_input.name = this.name;
    new_input.onchange = this.onchange;
    new_input.id = new_input.name;
    new_input.ll_obj = this.ll_obj;
    this.parentNode.insertBefore(new_input, this);

    var form = ll_obj.form;
    form.innerHTML = '';
    form.appendChild(this);
    form.submit();
    ll_obj.uploading = true;
    ll_obj.uploaded = false;
    ll_obj.already_uploaded = false;
    ll_obj.requester.start();
  },

  finish_uploading : function (info) {
    for (var i=0; i < this.vars.length; i++) {if (info[this.vars[i]]) {this[this.vars[i]] = info[this.vars[i]];}}
    this.uploading = false;
    this.uploaded = true;
    this.requester.stop();
    this.update_progress(info);
    if (typeof(this.onload) == 'function') {
      this.onload();
    }
  },

  send_error : function (string, id) {
    obj = LightLoader.prototype.get_by_id(id);
    if (obj) {
      obj.update_progress({'percent' : 0 });
	  obj.clear_vars();
	  //obj.iframe.src = 'about:blank';
	  obj.requester.stop();
      if (obj.onerror instanceof Function) { obj.onerror(string);}
    } else {
      alert(string);
    }
    
    
  },
  // This adds the needed variables that will tell the final script where the files are
  // and other information about them.

  on_form_submit : function(e) {

    if (LightLoader.prototype.still_uploading()) {
      alert('Please allow all files to upload or cancel any remaining uploads to post.');
      return true;  // Returning true stops the post
    }

    e = e || window.event;
    var form = ss.get_target(e);
    ss.extend(form);
    form.enctype = ''; // This is to make sure that files do not get uploaded twice
    var all = LightLoader.prototype.all;
    var i, i2, eles, ele;

    var inp = document.createElement('input');
    inp.setAttribute('type', 'hidden');

    var vars = LightLoader.prototype.vars;
	vars[vars.length]  ='ids';
	
    // Remove all existing var names - makes sure there are no duplicates
    for (i=0; i < vars.length; i++) {
      eles = form.$s('ll_'+vars[i]+'[]', 'name');
      for (i2=0; ele = eles[i2]; i2++) {form.removeChild(ele);}
    }

    // Add variables to post.
    for (i=0; i < all.length; i++) {
      inp_c = inp.cloneNode(false);
      inp_c.name = 'll_ids[]';
      inp_c.value = all[i].id;
      form.appendChild(inp_c);
      
      inp_c = inp.cloneNode(false);
      inp_c.name = 'll_db_ids[]';
      inp_c.value = all[i].already_uploaded ? all[i].db_id : 0;
      form.appendChild(inp_c);
      
      if (all[i].attach_to == form && (all[i].uploaded || all[i].already_uploaded)) {
        for (i2=0; i2 < vars.length; i2++) {
          inp_c = inp.cloneNode(false);
          inp_c.name = 'll_' + vars[i2]+ '[]';
          if (all[i][vars[i2]] || all[i][vars[i2]] === 0) {inp_c.value = all[i][vars[i2]];}
          form.appendChild(inp_c);
        }
      }
    }
    return false;  // A value of false allows the post to continue.  Weird, I know...
  }
};
