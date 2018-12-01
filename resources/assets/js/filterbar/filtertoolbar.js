var FilterToolbarModel = function (options) {
        var self = this;

        self.options = options;

        self.tabClickedHandlerIds = [];
        self.collapseClickHandlerIds = [];
        self.indicatorClickHandlerIds = [];

        var filterBar;

        if (self.options.include_datacenter != undefined && self.options.include_datacenter) {
                filterBar = this.createCollapsibleFilterBar('datacenter', "Datacenter", self.options.datacenters);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        if (self.options.include_environment != undefined && self.options.include_environment) {
                filterBar = this.createCollapsibleFilterBar('environment', "Environment", self.options.environments);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        if (self.options.include_cluster != undefined && self.options.include_cluster) {
                filterBar = this.createCollapsibleFilterBar('cluster', "Cluster", self.options.clusters);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        if (self.options.include_statuses != undefined && self.options.include_statuses) {
                filterBar = this.createCollapsibleFilterBar('statuses', "Status", self.options.statuses);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        if (self.options.include_monitored != undefined && self.options.include_monitored) {
                filterBar = this.createCollapsibleFilterBar('monitored', "Monitored", self.options.monitored);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        if (self.options.include_report_type != undefined && self.options.include_report_type) {
                filterBar = this.createCollapsibleFilterBar('reporttype', "Report Type", self.options.reporttypes);

                $('#' + self.options.parent_div_id)[0].appendChild(filterBar);
        }

        $('#' + self.options.parent_div_id)[0].setAttribute("class", "filterbar-group");


        self.tabClickedHandlerIds.forEach(function (id) {
                $("#" + id).bind("click", function (e) {
                        self.tabClicked(e);
                });

        });

        if (self.options.include_collapsebtn) {
                self.collapseClickHandlerIds.forEach(function (id) {
                        $("#" + id).bind("click", function (e) {
                                self.filterBarCollapseClicked(e);
                        });
                });
        }

        if (self.options.include_indicators) {
                self.indicatorClickHandlerIds.forEach(function (id) {
                        $("#" + id).bind("click", function (e) {
                                self.indicatorClicked(e);
                        });
                });
        }
}

FilterToolbarModel.prototype.setTabClickHandler = function (h) {
        this.options.tab_click_handler = h;
}

FilterToolbarModel.prototype.tabClicked = function (e) {
        self = this;

        if (self.options.tab_click_handler == null) {
                return;
        }

        var target = e.currentTarget;

        if ($('#' + target.id).hasClass("selected")) {
                $('#' + target.id).removeClass("selected");
        } else {
                $('#' + target.id).addClass("selected");
        }

        self.options.tab_click_handler(JSON.parse($('#' + target.id)[0].attributes["data-element"].nodeValue));
}

FilterToolbarModel.prototype.filterBarCollapseClicked = function (e) {
        self = this;

        var target = e.currentTarget;

        var currentState = $('#' + target.id)[0].attributes["data-state"].nodeValue;
        var destTarget = $('#' + target.id)[0].attributes["data-element"].nodeValue;

        if (currentState == "expanded") {
                $('#' + target.id)[0].attributes["data-state"].nodeValue = "collapsed";
                $('#' + destTarget)[0].setAttribute("style", "display: none;");
                $('#' + target.id).removeClass("fa-minus-square").addClass("fa-plus-square");
        } else {
                $('#' + target.id)[0].attributes["data-state"].nodeValue = "expanded";
                $('#' + destTarget)[0].setAttribute("style", "display: block;");
                $('#' + target.id).removeClass("fa-plus-square").addClass("fa-minus-square");
        }
}

FilterToolbarModel.prototype.indicatorClicked = function (e) {
        self = this;

        var target = e.currentTarget;

        if (self.options.indicator_click_handler == null) {
                return;
        }

}

FilterToolbarModel.prototype.createTabElement = function (id, label, level, tabNum) {
        self = this;

        var outerDiv = document.createElement("div");

        var innerDiv1 = document.createElement("div");

        innerDiv1.setAttribute("class", "filterbar-tab-title");

        var anchor = document.createElement("a");

        anchor.setAttribute("id", id + "-anchor");

        anchor.appendChild(document.createTextNode(label));

        innerDiv1.appendChild(anchor);

        outerDiv.appendChild(innerDiv1);

        if (self.options.include_indicators) {
                var indicatorDiv = document.createElement("div");
                /*
                indicatorDiv.setAttribute("class", "filterbar-indicator-green");
                indicatorDiv.setAttribute("id", id + "-status-indicator");
                indicatorDiv.appendChild(document.createTextNode("17"));

                self.indicatorClickHandlerIds.push(id + "-status-indicator");
*/
                indicatorDiv.setAttribute("class", "filterbar-indicator");
                indicatorDiv.setAttribute("data-bind", "html: $root.tabHtmlIndicators(" + level + "," + tabNum + ")");

                outerDiv.appendChild(indicatorDiv);
        }

        var innerDiv2 = document.createElement("div");

        innerDiv2.setAttribute("style", "clear: both;");

        outerDiv.appendChild(innerDiv2);

        //    self.tabClickedHandlers.push(id + "-anchor-div");

        return outerDiv;

        return innerDiv1;
}

FilterToolbarModel.prototype.createCollapsibleFilterBar = function (id, label, elements) {
        self = this;

        var filterBar = document.createElement("div");

        filterBar.setAttribute("class", "filterbar-panel");

        var filterBarDiv = document.createElement("div");

        filterBarDiv.setAttribute("class", "filterbar-outer-div");
        filterBarDiv.setAttribute("id", id + '-filterbar-div');

        //  Actual table when not collapsed

        var mainTable = document.createElement("table");

        mainTable.setAttribute("style", "width: 100%;table-layout: fixed;");
        mainTable.setAttribute("id", id + "-main-table");

        var mainTableRow = document.createElement("tr");

        var mainTableRowCol1 = document.createElement("td");

        if (self.options.include_collapsebtn) {
                var mainTableRowCol2 = document.createElement("td");

                mainTableRowCol2.setAttribute("class", "filterbar-collapse-td");

                if (self.options.include_collapsebtn) {
                        var collapseBtn = document.createElement("a");
                        var collapseBtnImage = document.createElement("i");

                        collapseBtnImage.setAttribute("class", "fa fa-minus-square filterbar-expand-collapse-btn");
                        collapseBtnImage.setAttribute("id", id + '-collapse-image');
                        collapseBtnImage.setAttribute("data-element", id + "-buttons-td");
                        collapseBtnImage.setAttribute("data-state", "expanded");

                        self.collapseClickHandlerIds.push(id + '-collapse-image');

                        collapseBtn.appendChild(collapseBtnImage);

                        mainTableRowCol2.appendChild(collapseBtn);
                }
        }

        mainTableRow.appendChild(mainTableRowCol1);

        if (self.options.include_collapsebtn) {
                mainTableRow.appendChild(mainTableRowCol2);
        }

        mainTable.appendChild(mainTableRow);

        //  filterBarTable needs to be in the first column of a 2 column table

        var filterBarTable = document.createElement("table");

        filterBarTable.setAttribute("align", "center");
        filterBarTable.setAttribute("id", id + "-tabs-table");

        var filterBarTableRow = document.createElement("tr");

        var filterBarTableCol1 = document.createElement("td");

        var filterBarTableCol1Table = document.createElement("table");

        var filterBarTableCol1TableRow = document.createElement("tr");

        var filterBarTableCol1TableCol1 = document.createElement("td");

        filterBarTableCol1TableCol1.setAttribute("class", "filterbar-title");

        var filterBarTableCol1TableCol1TextNode = document.createTextNode(label);

        filterBarTableCol1TableCol1.appendChild(filterBarTableCol1TableCol1TextNode);

        var filterBarTableCol1TableCol2 = document.createElement("td");

        filterBarTableCol1TableCol2.setAttribute("id", id + "-buttons-td");

        var filterBarTableCol1TableCol2UL = document.createElement("ul");

        filterBarTableCol1TableCol2UL.setAttribute("class", "nav nav-pills filterbar");


        //  Create li tabs

        var tabNum = 0;

        elements.forEach(function (e) {
                var html_id = e.name.replace(' ', '-') + '-' + e.type + '-' + 'tab';

                var filterBarTableCol1TableCol2ULLI = document.createElement("li");

                filterBarTableCol1TableCol2ULLI.setAttribute("data-element", JSON.stringify(e));

                filterBarTableCol1TableCol2ULLI.setAttribute("class", "filterbar-nav-item");
                filterBarTableCol1TableCol2ULLI.setAttribute("id", html_id);

                self.tabClickedHandlerIds.push(html_id);

                filterBarTableCol1TableCol2ULLI.appendChild(self.createTabElement(html_id, e.name, e.level, tabNum++));

                filterBarTableCol1TableCol2UL.appendChild(filterBarTableCol1TableCol2ULLI);
        });


        filterBarTableCol1TableCol2.appendChild(filterBarTableCol1TableCol2UL);

        filterBarTableCol1TableRow.appendChild(filterBarTableCol1TableCol1);
        filterBarTableCol1TableRow.appendChild(filterBarTableCol1TableCol2);

        //      filterBarTableRow.appendChild(filterBarTableCol1TableRow);

        filterBarTable.appendChild(filterBarTableCol1TableRow);


        mainTableRowCol1.appendChild(filterBarTable);

        filterBarDiv.appendChild(mainTable);

        filterBar.appendChild(filterBarDiv);

        return filterBar;
}

FilterToolbarModel.prototype.setTabSelected = function (tabType, tabName, selected) {
        var target = $('#' + tabName.replace(' ', '-') + '-' + tabType + '-tab');

        if (selected) {
                if (!target.hasClass("selected")) {
                        target.addClass("selected");
                }
        } else {
                if (target.hasClass("selected")) {
                        target.removeClass("selected");
                }
        }
}
/*
function Binding(b) {
        _this = this
        this.elementBindings = []
        this.value = b.object[b.property]
        this.valueGetter = function () {
                return _this.value;
        }
        this.valueSetter = function (val) {
                _this.value = val
                for (var i = 0; i < _this.elementBindings.length; i++) {
                        var binding = _this.elementBindings[i]
                        binding.element[binding.attribute] = val
                }
        }
        this.addBinding = function (element, attribute, event) {
                var binding = {
                        element: element,
                        attribute: attribute
                }
                if (event) {
                        element.addEventListener(event, function (event) {
                                _this.valueSetter(element[attribute]);
                        })
                        binding.event = event
                }
                this.elementBindings.push(binding)
                element[attribute] = _this.value
                return _this
        }

        Object.defineProperty(b.object, b.property, {
                get: this.valueGetter,
                set: this.valueSetter
        });

        b.object[b.property] = this.value;
}

var obj = {
        a: 123
}
var myInputElement1 = document.getElementById("myText1")
var myInputElement2 = document.getElementById("myText2")
var myDOMElement = document.getElementById("myDomElement")

new Binding({
                object: obj,
                property: "a"
        })
        .addBinding(myInputElement1, "value", "keyup")
        .addBinding(myInputElement2, "value", "keyup")
        .addBinding(myDOMElement, "innerHTML")

obj.a = 456;
*/