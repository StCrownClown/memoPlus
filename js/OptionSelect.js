var data;

	data = $("#select_json").val();
	json_obj = JSON.parse(data);

RegExp.prototype.execAll = function(string) {
    var match = null;
    var matches = new Array();
    while (match = this.exec(string)) {
        var matchArray = [];
        for (i in match) {
            if (parseInt(i) == i) {
                matchArray.push(match[i]);
            }
        }
        matches.push(matchArray);
    }
    return matches;
}
//var results = select_id_re.execAll(html_result);

var Name_select;
var Name_arr;
var option_loop;
var name_att;

for(x=1;x<json_obj.length;x++) {
	Name_select = json_obj[x].Name_select;
	Name_arr = json_obj[x].Name.split(';');
	option_loop = "";
		for(y=0;y<Name_arr.length;y++) {
			if(y>=1 && Name_arr[y].length==0) {}
			else {
				option_loop += '<option value="'+Name_arr[y]+'">'+Name_arr[y]+'</option>';
			}
		}
		$("[id^=Select"+Name_select+"]").each(function () {
			name_att = $(this).attr('id');
				if (name_att.substring(6,name_att.length-2)==Name_select) { 
					$(this).find('option').remove().end();
					$(this).append(option_loop);
				}
		  });
}