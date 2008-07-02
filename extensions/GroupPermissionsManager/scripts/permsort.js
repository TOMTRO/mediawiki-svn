//for the Special:SortPermissions page

//Adds a new column (sort type) to the table
function addColumn() {
	var table = document.getElementById('sorttable');
	var ste = document.getElementById('sorttypes');
	var colname = document.getElementById('wpNewType').value;
	if(!colname || colname == '') return false;
	types[numtypes] = colname;
	numtypes++;
	var rows = table.getElementsByTagName('tr');
	for(var i=0;i<rows.length;i++) {
		var td = document.createElement('td');
		var btn = document.createElement('input');
		var rowname = rows[i].id;
		btn.type = 'radio';
		btn.name = 'right-' + rowname;
		btn.id = rowname + '-' + colname;
		btn.value = colname;
		var lbl = document.createElement('label');
		lbl.htmlFor = rowname + '-' + colname;
		var text = document.createTextNode(colname);
		lbl.appendChild(text);
		td.appendChild(btn);
		td.appendChild(lbl);
		rows[i].appendChild(td);
	}
	ste.value = ste.value + '|' + colname;
	return true;
}

//Adds a new row (permission) to the table
function addRow() {
	var table = document.getElementById('sorttable');
	var rowname = document.getElementById('wpNewPerm').value;
	if(!rowname || rowname == '') return false;
	var tr = document.createElement('tr');
	tr.id = rowname;
	var td = [];
	td[0] = document.createElement('td');
	var text = document.createTextNode(rowname);
	td[0].appendChild(text);
	tr.appendChild(td[0]);
	for(var i=1;i<=numtypes;i++) {
		td[i] = document.createElement('td');
		var btn = document.createElement('input');
		btn.type = 'radio';
		btn.name = 'right-' + rowname;
		btn.id = rowname + '-' + types[i-1];
		btn.value = types[i-1];
		var lbl = document.createElement('label');
		lbl.htmlFor = rowname + '-' + types[i-1];
		var text = document.createTextNode(types[i-1]);
		lbl.appendChild(text);
		td[i].appendChild(btn);
		td[i].appendChild(lbl);
		tr.appendChild(td[i]);
	}
	table.appendChild(tr);
	return true;
}