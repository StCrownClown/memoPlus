var data;

data = $("#select_json").val();
json_obj = JSON.parse(data);

RegExp.prototype.execAll = function (string) {
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

var select_val;
var name_arr;
var option_loop;
var name_att;

for (x = 1; x < json_obj.length; x++) {
    select_val = json_obj[x].Name_select;
    name_arr = json_obj[x].Name.split(';');
    option_loop = "";
    for (y = 0; y < name_arr.length; y++) {
        if (y >= 1 && name_arr[y].length == 0) {
        } else {
            option_loop += '<option value="' + name_arr[y] + '">' + name_arr[y] + '</option>';
        }
    }
    
    var select_res = $( "select[id*=Select" + select_val + " i]")[0];
    if(select_res) {
        select_res = select_res.id;
        select_res = select_res.substring(0,select_res.length - 2);
        $("[id^=" + select_res + "]").each(function () {
            name_att = $(this).attr('id');
            if (name_att.substring(6, name_att.length - 2).toLowerCase() == select_val.toLowerCase()) {
                $(this).find('option').remove().end();
                $(this).append(option_loop);
            }
        });
    }
}