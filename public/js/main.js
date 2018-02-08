function tt(param1, param2) {
    var id         = null,
        locale     = null,
        parameters = {},
        number     = 0,
        plurals    = false,
        old_locale = Lang.getLocale(),
        translation;
    if (typeof param1 === 'object') {
        if (param1 === null)
            return Lang;
        if (typeof param1['id'] !== 'undefined') {
            id         = param1['id'];
            locale     = typeof param1['locale'] !== 'undefined' ? param1['locale'] : locale;
            parameters = typeof param1['parameters'] !== 'undefined' ? param1['parameters'] : parameters;
            if (typeof param1['number'] !== 'undefined') {
                switch (typeof param1['number']) {
                    case 'boolean':
                        plurals = true;
                        number  = !param1['number'] ? 1 : 2;
                        break;
                    case 'number':
                        plurals = true;
                        number  = param1['number'];
                        break;
                }
            }
        } else {
            var data = [];
            $.each(param1, function(key, value) {
                data[key] = tt(value);
            });
            return data.join(' ');
        }
    } else if (typeof param1 === 'string') {
        id = param1;
        switch (typeof param2) {
            case 'string':
                locale = param2;
                break;
            case 'object':
                parameters = param2;
                break;
            case 'number':
                plurals = true;
                number  = param2;
                break;
            case 'boolean':
                plurals = true;
                number  = !param2 ? 1 : 2;
                break;
            case 'undefined':
                break;
            default:
                throw new Error("param2: Type not supported");
                break;
        }
    } else if (typeof param1 === 'undefined') {
        return Lang;
    } else
        throw new Error("param1: Type not supported");

    if (typeof lang_custom !== 'undefined') {
        var segments = id.split('.');
        var source   = segments[0];
        var entries  = segments.slice(1);
        var message  = lang_custom[source];
        if (typeof message !== 'undefined') {
            while (entries.length && (message = message[entries.shift()]));
            if (typeof message !== 'undefined')
                id = message;
            else if (typeof Lang.get(id) === 'object') {
                if (typeof lang_custom.country_iso !== 'undefined')
                    id += Lang.has(id + '.' + lang_custom.country_iso) ? '.' + lang_custom.country_iso : '.xx';
                else
                    id += '.xx';
            }
        }
    }

    if (locale !== null)
        Lang.setLocale(locale);

    if (plurals)
        translation = Lang.choice(id, number, parameters);
    else
        translation = typeof Lang.get(id, parameters) === 'string'
            ? Lang.get(id, parameters).split('|')[0]
            : Lang.get(id, parameters);

    if (locale !== null)
        Lang.setLocale(old_locale);

    return translation;
}
function createDataTableStandar(selector, opt) {
    if (typeof opt.scroll === 'undefined')
        opt.scroll = true;
    var myTable = $(selector).DataTable(opt);
    $(".dataTables_filter input[aria-controls='" + selector.substring(1) + "']").unbind().bind("keyup", function(e) {
        //if(this.value.length >= 3 || e.keyCode == 13) {
        if (e.keyCode == 13) {
            myTable.search(this.value).draw();
            return;
        }
        if (this.value == "")
            myTable.search("").draw();
        return;
    });
    if (opt.scroll) {
        myTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top
            }, 'fast');
        });
    }
    return myTable;
}
function getOpt() {
    var opt = {
        processing     : true,
        serverSide     : true,
        destroy        : true,
        ajax           : '',
        columns        : [],
        sDom           : 'r<Hlf><"datatable-scroll"t><Fip>',
        pagingType     : "simple_numbers",
        iDisplayLength : 5,
        aLengthMenu    : [[5, 10, 50, -1], [5, 10, 50, tt('pagination.datatables.all', lang_locale)]],
        oLanguage      : {
            sSearch         : "<span>" + tt('search.label', lang_locale) + ":</span> ",
            sProcessing     : "<div class='text-center'>" + tt('search.processing', lang_locale) + "</div>",
            sZeroRecords    : tt('search.zero_records', lang_locale),
            sEmptyTable     : tt('search.empty_table', lang_locale),
            sLoadingRecords : tt('actions.loading.label', lang_locale),
            sInfo           : tt('pagination.datatables.info', lang_locale),
            sInfoEmpty      : tt('pagination.datatables.info_empty', lang_locale),
            sInfoFiltered   : tt('pagination.datatables.info_filtered', lang_locale),
            sLengthMenu     : tt('pagination.datatables.length_menu', lang_locale),
            oPaginate       : {
                sFirst    : tt('pagination.first', lang_locale),
                sLast     : tt('pagination.last', lang_locale),
                sNext     : tt('pagination.next.label', lang_locale),
                sPrevious : tt('pagination.previous.label', lang_locale)
            },
            select          : {
                rows : {
                    _ : Lang.choice('pagination.datatables.select.rows', 2, { num : '%d' }),
                    1 : Lang.choice('pagination.datatables.select.rows', 1, { num : '%d' }),
                    0 : ''
                }
            }
        }
    };
    return opt;
}