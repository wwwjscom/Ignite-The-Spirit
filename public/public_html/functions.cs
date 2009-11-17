private void dononq(string sql, SqlConnection dbconn) {
	SqlCommand cm = new SqlCommand(sql, dbconn);
	dbconn.Open();
	cm.ExecuteNonQuery();
	dbconn.Close();
}
private string clean(string v, int length) {
	v = v.Replace("~", " ");
	v = v.Replace("'", "''");
	v = v.Replace("<", "&lt;");
	v = v.Replace(">", "&gt;");
	if (v.Length > length) v = v.Substring(0, length);
	return(v);
}
private double per(int v1, int v2) {
	double ret;

	ret = (double)v1 / (double)v2 * 1000;
	ret = Math.Floor(ret);
	ret = ret / 10.0;

	return(ret);
}
