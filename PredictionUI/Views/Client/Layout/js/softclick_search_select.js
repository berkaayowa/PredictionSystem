(function() {
    var SearchSelect;

    SearchSelect = (function() {
        var concatOptions, fetchData, hideList, hideSpinner, initLoadData, initSearchSelect, showList, showSpinner, timeout, typeIsArray, typeIsFunction, typeIsString;

        timeout = null;

        function SearchSelect(Element, Options) {
            var searchIcon, searchInputGroup, searchInputWrapper;
            this.Element = Element;
            this.Options = Options;
            this.Source = this.Element.attr('data-source');
            if (!this.Source || this.Source.length === 0) {
                this.Source = this.Options.source;
            }
            this.SelectContainer = $('<div>').addClass('select-container').attr('id', 'search_select_' + this.Element.attr('id')).attr('data-is-searchable', true).appendTo(this.Element.parent());
            this.Element.addClass('hidden');
            this.Button = $('<button>').attr('type', 'button').addClass('form-control btn btn-default').html(this.Options.selected.text && this.Options.selected.text.trim() !== '' ? this.Options.selected.text : this.Options.title).appendTo(this.SelectContainer);
            this.ArrowDownIcon = $('<b>').addClass('caret pull-right').appendTo(this.Button);
            this.SearchDropDownContainer = $('<div>').addClass('search-container hidden').css('min-height', '63px').css('max-height', '300px').appendTo(this.SelectContainer);
            if (this.Options.searchable) {
                searchInputWrapper = $('<div>').addClass('search-input-wrapper inputSearchFocus').css('text-align', 'center').appendTo(this.SearchDropDownContainer);
                searchInputGroup = $('<div>').addClass('search-input-group pull-left').appendTo(searchInputWrapper);
                searchIcon = $('<i>').addClass('glyphicon glyphicon-search pull-left').appendTo(searchInputGroup);
                this.SearchInput = $('<input>').addClass('pull-left').attr('id', 'input_search_' + this.Element.attr('id')).attr('placeholder', this.Options.searchPlaceholder).attr('type', this.Options.inputType).attr('data-search-for', '').on('keyup', (function(_this) {
                    return function(e) {
                        var self, value;
                        self = _this;
                        clearTimeout(timeout);
                        value = $(e.target).val();
                        timeout = setTimeout(function() {
                            if (value && value.length > 2) {
                                fetchData({
                                    search: value
                                }, self);
                            }
                            if (value.length === 0) {
                                fetchData({
                                    search: ''
                                }, self);
                            }
                        }, 1000);
                    };
                })(this)).appendTo(searchInputGroup);
            }
            this.SelectSearchListWrapper = $('<div>').addClass('select-list-wrapper hidden').appendTo(this.SearchDropDownContainer);
            this.SearchList = $('<ul>').attr('data-search-list', '').attr('id', 'search_list' + this.Element.attr('id')).appendTo(this.SelectSearchListWrapper);
            this.Spinner = $('<img>').attr('src', this.Options.spinner).attr('id', 'searchselectloading').css('height', '20px').addClass('pull-right');
            this.Button.on('click', (function(_this) {
                return function(e) {
                    if (_this.Options.autoLoad) {
                        showList(_this);
                    } else {
                        fetchData({
                            search: ''
                        }, _this);
                    }
                };
            })(this));
            this.Element.appendTo(this.SearchDropDownContainer);
            this.Count = 0;
            this.Data = [];
            this.SelectedId = this.Options.selected.id;
            if (this.Options.autoLoad) {
                fetchData({
                    search: ''
                }, this);
            }
            return;
        }

        SearchSelect.prototype.setOptions = function(newOptions) {
            if (newOptions.onItemSelect) {
                this.Options.onItemSelect = newOptions.onItemSelect;
            }
            if (newOptions.getCount) {
                this.Options.getCount = newOptions.getCount;
            }
            if (newOptions.source) {
                this.Options.source = newOptions.source;
                self.Source = newOptions.source;
            }
        };

        SearchSelect.prototype.getSelectedData = function() {
            var i, item, len, ref;
            ref = this.Data;
            for (i = 0, len = ref.length; i < len; i++) {
                item = ref[i];
                var mappedItem = this.Options.onItemMap(item);
                if (mappedItem.value == this.SelectedId) {
                    return item;
                }
            }
            return null;
        };

        SearchSelect.prototype.setValue = function(value) {
            this.SelectedId = value;
            this.Button.html(value + '<b class="caret pull-right"></b>');
            this.Element.val(value);
            return null;
        };

        fetchData = function(requestOptions, self) {
            var requestUrl;
            if (typeIsFunction(self.Source)) {
                self.SearchList.html('');
                self.Element.html('');
                showSpinner(self.ArrowDownIcon, self.Spinner);
                self.Source(requestOptions.search, function(data) {
                    self.Data = data;
                    if (typeof requestOptions.search === 'undefined') {
                        initLoadData({}, self);
                    } else {
                        initLoadData({
                            key: requestOptions.search
                        }, self);
                    }
                    hideSpinner(self.Spinner, self.ArrowDownIcon);
                    if (!self.Options.autoLoad) {
                        showList(self);
                    }
                });
            } else {
                requestUrl = self.Source;
                if (requestOptions.search && requestOptions.search.length > 0) {
                    requestUrl = self.Source + '&query=' + requestOptions.search;
                }
                $.ajax(requestUrl, {
                    type: self.Options.requestType,
                    dataType: 'json',
                    beforeSend: function() {
                        self.SearchList.html('');
                        self.Element.val('');
                        return showSpinner(self.ArrowDownIcon, self.Spinner);
                    },
                    success: function(data, textStatus, jqXHR) {
                        self.Data = data;
                        if (typeof requestOptions.search === 'undefined') {
                            initLoadData({}, self);
                        } else {
                            initLoadData({
                                key: requestOptions.search
                            }, self);
                        }
                    },
                    error: function(data, textStatus, jqXHR) {
                        self.SearchList.html('<li class="select-search-no-result" data-search-value>Could not connect to the server </li>');
                        self.Element.val('');
                    },
                    complete: function() {
                        hideSpinner(self.Spinner, self.ArrowDownIcon);
                        if (!self.Options.autoLoad) {
                            showList(self);
                        }
                        self.Count++;
                        if (self.Options.getCount) {
                            self.Options.getCount(self.Count);
                        }
                    }
                });
            }
        };

        initLoadData = function(search, self) {
            var found, i, item, len, listItem, mappedItem, onListClick, ref;
            found = 0;
            onListClick = function(e) {
                var text;
                text = $(this).text();
                self.SelectedId = $(this).data('search-value');
                if (self.Options.searchable) {
                    self.SearchInput.val(text);
                }
                self.Element.val(self.SelectedId);
                self.Element.attr('value', self.SelectedId);
                self.Button.html(text + '<b class="caret pull-right"></b>');
                if (self.Options.onItemSelect) {
                    self.Options.onItemSelect(self.getSelectedData());
                }
                hideList(self);
            };
            ref = self.Data;
            for (i = 0, len = ref.length; i < len; i++) {
                item = ref[i];
                mappedItem = self.Options.onItemMap(item);

                listItem = $('<li>').attr('data-search-value', mappedItem.value).css('text-transform', 'capitalize').addClass(found === 0 ? 'first-matched' : void 0).html(mappedItem.label).on('click', onListClick);
                listItem.appendTo(self.SearchList);

                if (self.Options.selected.id === mappedItem.value) {
                    self.Button.html(mappedItem.label + '<b class="caret pull-right"></b>');
                    self.Element.attr('value', mappedItem.value);
                }
                found++;
            }
            initSearchSelect(self);
            if (found === 0) {
                self.SearchList.html('<li class="select-search-no-result" data-search-value>No result</li>');
                self.Element.val('');
            }
        };

        showSpinner = function(currentElement, newElement) {
            currentElement.replaceWith(newElement);
        };

        hideSpinner = function(currentElement, newElement) {
            currentElement.replaceWith(newElement);
        };

        hideList = function(self) {
            self.SearchDropDownContainer.addClass('hidden');
            self.SelectSearchListWrapper.addClass('hidden');
            self.Button.removeClass('btn-pressed');
            self.SelectContainer.removeClass('select-container-onfocus');
        };

        showList = function(self) {
            self.SelectSearchListWrapper.removeClass('hidden');
            self.Button.addClass('btn-pressed');
            if (self.Options.searchable) {
                self.SearchInput.focus();
            }
            self.SearchDropDownContainer.removeClass('hidden');
            self.SelectContainer.addClass('select-container-onfocus');
        };

        concatOptions = function(url) {
            url.con;
        };

        initSearchSelect = function(self) {
            $(self.SearchList).on('mouseover', function() {
                self.SearchList.find('li').first().removeClass('first-matched');
            });
            self.SelectContainer.on('focusout', function() {});
            $(document).on('click', function(e) {
                if (!self.SelectContainer.is(e.target) && self.SelectContainer.has(e.target).length === 0) {
                    hideList(self);
                }
            });
        };

        typeIsArray = function(value) {
            return value && typeof value === 'object' && value instanceof Array && typeof value.length === 'number' && typeof value.splice === 'function' && !(value.propertyIsEnumerable('length'));
        };

        typeIsString = function(value) {
            return value && typeof value === 'string' && value instanceof String;
        };

        typeIsFunction = function(value) {
            return value && typeof value === 'function';
        };

        return SearchSelect;

    })();

    $.fn.searchselect = function(options, params) {
        var args, elements, methodCalled, value;
        args = [];
        value = null;
        methodCalled = false;
        Array.prototype.push.apply(args, arguments);
        elements = this.each(function() {
            var $this, select;
            $this = $(this);
            select = $this.data('SearchSelect');
            if (typeof options === 'string' && select && select[options]) {
                args.shift();
                value = select[options].apply(select, args);
                methodCalled = true;
            } else if (!select && typeof options !== 'string' && !params) {
                options = $.extend(true, {}, $.fn.searchselect.defaults, options);
                select = new SearchSelect($this, options);
                $this.data('SearchSelect', select);
                methodCalled = false;
            }
        });
        if (methodCalled) {
            return value;
        } else {
            return elements;
        }
    };

    $.fn.searchselect.defaults = {
        source: null,
        id: 'select',
        title: 'Please select',
        inputType: 'text',
        requestType: 'GET',
        selected: '',
        searchable: true,
        searchPlaceholder: 'Search',
        onItemSelect: null,
        onItemMap: function(item) {
            return {
                value: item.id,
                label: item.name
            };
        },
        spinner:'/Views/Client/Assets/spinner.gif',
        autoLoad: false,
        onEditLoad: null
    };

}).call(this);
