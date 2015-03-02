tt_content.bootstrap_package_panel = COA
tt_content.bootstrap_package_panel {

	stdWrap.outerWrap.cObject = CASE
	stdWrap.outerWrap.cObject {
		key {
			field = layout
		}
		default = TEXT
		default.value = <div class="panel panel-default"> | </div>
		110 = TEXT
		110.value = <div class="panel panel-primary"> | </div>
		120 = TEXT
		120.value = <div class="panel panel-success"> | </div>
		130 = TEXT
		130.value = <div class="panel panel-info"> | </div>
		140 = TEXT
		140.value = <div class="panel panel-warning"> | </div>
		150 = TEXT
		150.value = <div class="panel panel-danger"> | </div>
	}

	10 < tt_content.textpic.10.10
	10 {
		wrap = <div class="panel-heading"> | </div>
		3.headerClass.cObject.20.value =
		3.headerClass.cObject.30 = TEXT
		3.headerClass.cObject.30.value = panel-title
	}

	20 = COA
	20 {
		wrap = <div class="panel-body"> | </div>
		20 < tt_content.textpic.20
		20.text.10 >
	}
}
