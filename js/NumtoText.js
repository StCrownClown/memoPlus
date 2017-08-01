// OnKeyPress="return ChkNumber(this)"
function ChkNumber(Num) {
    var nchar = String.fromCharCode(event.keyCode);
    if ((nchar < '0' || nchar > '9') && (nchar != '.') && (nchar != ',') && (nchar != '-')) return false;
	Num = nchar;
}

function NumtoText() {
    var textbox_id = document.activeElement.id;
    var money = document.getElementById(textbox_id).value;
    money = money.replace(/,/g, "");

    if (money.match(/^\s*$/)) money = '';
    else if (!money.match(/([0-9]+)(\.[0-9]{0,4}){0,1}/g)) money = 'กรุณากรอกข้อมูลให้ถูกต้อง';
    else if (money == 0) money = 'ศูนย์บาทถ้วน';
    else {
        var result = '';
        var minus = '';

        if (money < 0) {
            minus = 'ติดลบ';
            money = money * -1;
        }
        money = parseFloat(Math.round(money * 100) / 100).toFixed(2);

        var numbers = ['', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
        var positions = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน'];
        var digit = money.length;
        var inputs = [];

        if (digit <= 15) {
            if (digit > 9) {
                inputs[0] = money.substr(0, digit - 9);
                inputs[1] = money.substr(inputs[0].length, 6);
            } else {
                inputs[0] = '00';
                inputs[1] = money.substr(0, money.length - 3);
            }
            inputs[2] = money.substr(money.indexOf('.') + 1, 2);
        }
        else return;

        for (i = 0; i < 3; i++) {
            var input = inputs[i];

            if (input != '0' && input != '00') {
                var digit = input.length;

                for (j = 0; j < digit; j++) {
                    var s = input.substr(j, 1);
                    var number = numbers[s];
                    var position = '';

                    if (number != '') position = positions[digit - (j + 1)];
                    if ((digit - j) == 2) {
                        if (s == '1') number = '';
                        else if (s == '2') number = 'ยี่';
                    } else if ((digit - j) == 1 && (digit != 1)) {
                        var pre_s = '0';

                        if (j > 0) pre_s = input.substr(j - 1, 1);
                        if (i == 0) {
                            if (pre_s != '0') {
                                if (s == '1' && input.substr(j - 1, 2) >= 10) number = 'เอ็ด';
                                else if (s == '1' && input.substr(j - 1, 2) <= 9) number = 'หนึ่ง';
                            }
                        } else {
                            if (s == '1' && input.substr(j - 1, 2) >= 10) number = 'เอ็ด';
                            else if (s == '1' && input.substr(j - 1, 2) <= 9) number = 'หนึ่ง';
                        }
                    }
                    result = result + number + position;
                }
            }

            if (i == 0) {
                if (input != '00') result = result + 'ล้าน';
            } else if (i == 1) {
                if (input != '0' && input != '00') {
                    result = result + 'บาท';
                    if (inputs[2] == '00') result = result + 'ถ้วน';
                }
            } else {
                if (input != '00') result = result + 'สตางค์';
            }
        }
        money = minus + result;
    }
    if (money.match(/undefined/g)) money = 'กรุณากรอกข้อมูลให้ถูกต้อง';
    var num_id = textbox_id.substring(3, 5);
    var numtext_id = textbox_id.substring(0, 3) + "TEXT" + num_id;
    var numtext_res = $( "input[id*="+numtext_id+" i]")[0].id;
    document.getElementById(numtext_res).value = money;
}


function NumtoTextEN(program) {
    this.funcpat = /(\|?(\uE008\()+)?(\|?\uE008\(([^\(\)]*)\)\|?)(\)+\|?)?/
    this.meta = "\\\"$()|#;"
    this.enc = "\uE000\uE001\uE002\uE003\uE004\uE005\uE006\uE007"
    this.lines = []
    if (/__numbertext__/.test(program)) {
	this.numbertext = true
	program = "0+(0|[1-9]\\d*) $1\n" + program.replace("__numbertext__", "")
    } else this.numbertext = false

    // subclass for line data
    this.linetype = function (regex, repl, begin, end) {
	this.pat = regex
	this.repl = repl
	this.begin = begin
	this.end = end
    };

    // strip function
    this.strip = function (st, ch) {
	if (st == undefined) return ""
	return st.replace(new RegExp("^" + ch + "+"), "")
	    .replace(new RegExp(ch + "+$"), "")
    };

    // character translation function
    this.tr = function (text, chars, chars2, delim) {
	for (var i = 0; i < chars.length; i++) {
	    var s = delim + chars[i]
	    while (text.indexOf(s) >= 0) {
		text = text.replace(s, chars2[i]);
	    }
	}
	return text
    };

    // private run function
    this._run = function (data, begin, end) {
	for (var i in this.lines) {
	    var l = this.lines[i]
	    if (! ((!begin && l.begin) || (!end && l.end))) {
		var m = l.pat.exec(data)
		if (m != null) {
		    var s = data.replace(l.pat, l.repl)
		    var n = this.funcpat.exec(s)
		    while (n != null) {
			var b = false
			var e = false
			if (n[3][0] == "|" || n[0][0] == "|") {
			    b = true
			} else if (n.index == 0) {
			    b = begin
			}
			if (n[3][n[0].length - 1] == "|" || n[3][n[0].length - 1] == "|") {
			    e = true
			} else if (n.index + n[0].length == s.length) {
			    e = end
			}
			s = s.substring(0, n.index + (n[1] == undefined ? 0 : n[1].length)) + this._run(n[4], b, e) +
			    s.substring(n.index + (n[1] == undefined ? 0 : n[1].length) + n[3].length)
			n = this.funcpat.exec(s)
		    }
		    return s
		}
	    }
	}
	return ""
    };

    // run with the string input parameter
    this.run = function (data) {
	data = this._run(this.tr(data, this.meta, this.enc, ""), true, true)
	if (this.numbertext) data = this.strip(data, " ").replace(/  +/g, " ")
	return this.tr(data, this.enc, this.meta, "")
    };

    // constructor
    program = this.tr(program, this.meta, this.enc, "\\")
    var l = program.replace(/(#[^\n]*)?(\n|$)/g, ";").split(";")
    for (var i in l) {
	var s = /^\s*(\"[^\"]*\"|[^\s]*)\s*(.*[^\s])?\s*$/.exec(l[i])
	if (s != null) {
	    s[1] = this.strip(s[1], "\"")
	    if (s[2] == undefined) s[2] = ""; else s[2] = this.strip(s[2], "\"")
	    var line = new this.linetype(
		new RegExp("^" + s[1].replace("^\^", "").replace("\$$", "") + "$"),
		s[2].replace(/\\n/g, "\n")
		    .replace(/(\$\d|\))\|\$/g,"$1||$$")
		    .replace(/\$/g, "\uE008")
		    .replace(/\\(\d)/g, "$$$1")
		    .replace(/\uE008(\d)/g, "\uE008($$$1)"),
		/^\^/.test(s[1]), /\$$/.test(s[1])
	    )
	    this.lines = this.lines.concat(line)
	}
    }
};


function convert() {
	toTextEN = new NumtoTextEN(document.getElementById('en_US').value);
	var textbox_id = document.activeElement.id;
    var s = document.getElementById(textbox_id).value;
	s = "THB " + s;
	s = s.replace(/,/g, "");
	var num_id = textbox_id.substring(5, 7);
    var numtext_id = "NumtextEN" + num_id;
    var numtext_res = $( "input[id*="+numtext_id+" i]")[0].id;
    document.getElementById(numtext_res).value = toTextEN.run(s);
}
