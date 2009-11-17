#!/usr/bin/perl

#******************************************************************************
# Lightloader
# Copyright (C) 2007  Jeremy Nicoll
#
# This library is free software; you can redistribute it and/or
# modify it under the terms of the GNU Lesser General Public
# License as published by the Free Software Foundation; either
# version 2.1 of the License, or (at your option) any later version.
#
# This library is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
# Lesser General Public License for more details.
#
# You should have received a copy of the GNU Lesser General Public
# License along with this library; if not, write to the Free Software
# Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
#
# Please see lgpl.txt for a copy of the license - this notice and the file
# lgpl.txt must accompany this code.
#
# Please go to forums.SeeMySites.net for questions and support of this library.
# Go to www.ScriptSing.com for code updates.
#*******************************************************************************

####################################################
#Configurable variables:
    $max_size = 5000000;
	$temp_dir = 'tempfiles/';   #make sure you include the trailing slash...
    $delay = 1;               #in seconds, delay for printing to the progress file
    @allowed_extensions = (            #You can add / delete any of them here.  This is for all standard web images.  Make sure you have a comma between each one.
        "jpg",
        "png",
        "gif",
        "jpeg"
    );
####################################################

# Print header
print "Content-type: text/html\r\n\r\n";

#import modules
use Fcntl qw(:flock);
use CGI qw(:standard);

# start timer
$start = time;
$next_print = 0;

print_progress(0);

# Prep content
print "<html>
<body> <pre>
";



# Get ID
@params = split(/&/, $ENV{'QUERY_STRING'});
@id = split(/=/,$params[0]);
$id = $id[1];
$id =~ s/[^a-zA-Z0-9_\-]//g;
if (!$id) {$supress_end_error = 1; exit;}

$error = 0;
$check_mime = 1;


$uploaded_file_progress = $temp_dir . $id . '_progress';
$uploaded_file = $temp_dir.$id.'_uploaded_file';


$u_size = $ENV{'CONTENT_LENGTH'};
if ($u_size > $max_size) {send_error ("Upload too big.  Maximum size is $max_size bytes");}


print_progress(0);
# Set up uploading function
$query = CGI->new(\&hook);

#define functions
sub hook  {
    if ($error) {return;}
    if (time >= $next_print) {
        $next_print = time + $delay;
        my ($filename, $buffer, $bytes_read, $data) = @_;
        if ($check_mime) {
	        $filename =~ m/\.([^\.]+)$/;
	        $ext = lc($1);
	        print $ext;
	        if (!grep($_ eq $ext, @allowed_extensions)) {send_error('Invalid file uploaded.  Files must be either JPEG, PNG, or GIF');}
	        $check_mime = 0;
        }
    	$percent = $bytes_read / $u_size;
        print_progress($percent);
    }
}

sub print_progress {
    open(PROG, '>'.$uploaded_file_progress);
    print PROG '{"percent" : ' . ($_[0] * 100) . '}';
    close PROG;
}

sub send_error {
	my $fh;
	my $err_msg = shift;
	$supress_end_error = 1;
    $error = 1;
    close (STDIN);

    if (defined($uploaded_file_loc)) {unlink($uploaded_file_loc);}

    open PROG, '>'.$uploaded_file_progress;
    print PROG '{"error" : "' . $err_msg .'"}';
    close PROG;
	exit;
}
#############

$uphandle = $query->upload($query->param());
binmode $uphandle;

if (!$error) {
    open OUTFILE, ">" . $uploaded_file;
    binmode OUTFILE;
    while (<$uphandle>) {print OUTFILE $_;}
    close OUTFILE;
    chmod 0644, $uploaded_file;
    
    open PROG, '>'. $uploaded_file_progress;
    print PROG '{"type" : "'.$query->uploadInfo($uphandle)->{'Content-Type'}.'",  "name": "'.$query->param($query->param()).'", "tmp_name" : "'. $id.'_uploaded_file", "percent" : 100}';
    close PROG;
}

$supress_end_error = 1;

END {
    if (!$supress_end_error) {send_error('Script aborted.  Error: ' . $!);}
	print "</pre>
    </body>
</html>";
}
