(function (window) {
	'use strict';
	var $ = window.jQuery,
		console = window.console,
        pos = 0;

    /************************* Contents *********************************
    User Login                                                    ~ LOGIN
    Save/Update Owner                                             ~ OWNER
    Existing Owners                                     ~ EXISTING OWNERS
    Property                                                   ~ PROPERTY
    Address                                                     ~ ADDRESS
    Levels                                                       ~ LEVELS
    Accommodations                                       ~ ACCOMMODATIONS
    Construct                                                 ~ CONSTRUCT
    Features                                                   ~ FEATURES
    Details                                                     ~ DETAILS
    Tax                                                             ~ TAX                                   
    Owner Validation                                  ~ OBJECT VALIDATION
    Load Owners                                           ~ OWNERS LOADER
    ************************ End Contents *******************************/

    var saving = '<img src="./img/save.gif" />';

    $(document).on('submit', '.login-form', function (e) {  //[~ LOGIN]
        $('.fields').addClass('hide');
        $('.loader').removeClass('hide');

        e.preventDefault();

        var submitData = {
            email: $('.login-form input[type="email"]').val(),
            password: $('.login-form input[type="password"]').val()
        };

        $.ajax({
            type: 'POST',
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(submitData),
            url: '/user/validate',
            success : function (result) {
                console.log('>>>>>>>>> LOGIN DATA:', result);
                if (result.status == 404) {
                    $('.errormsg').removeClass('hide');
                    $('.fields').removeClass('hide');
                    $('.loader').addClass('hide');
                } else {
                    $('.errormsg').addClass('hide');

                    if ($('.remember').prop('checked')) {
                        

                        if (result.brokerage.length >= 1) {
                            setCookie('b', result.brokerage[0].broker_id, 90);
                            localStorage.setItem('b', result.brokerage[0].broker_id);
                        } else {
                            setCookie('b', 0, 90);
                            localStorage.setItem('b', 0);
                        }

                        setCookie('access', result.data.usertype_id, 90);
                        setCookie('password', result.data.secret, 90);
                        setCookie('s', result.session.identifier, 90);
                        setCookie('t', result.session.token, 90);
                        setCookie('email', submitData.email, 90);
                        setCookie('i', result.data.id, 90);
                        setCookie('active', true, 90);

                        localStorage.setItem('access', result.data.usertype_id);
                        localStorage.setItem('i', result.data.id);

                    } else {

                        if (result.brokerage.length >= 1) {
                            setCookie('b', result.brokerage[0].broker_id, 1/48);
                            localStorage.setItem('b', result.brokerage[0].broker_id);
                        } else {
                            setCookie('b', 0, 1/48);
                            localStorage.setItem('b', 0);
                        }
                        
                        setCookie('access', result.data.usertype_id, 1/48);
                        setCookie('password', result.data.secret, -190);
                        setCookie('s', result.session.identifier, -190);
                        setCookie('t', result.session.token, -190);
                        setCookie('email', submitData.email, -190);
                        setCookie('i', result.data.id, 1/48);
                        setCookie('active', true, 1/48);

                        localStorage.setItem('access', result.data.usertype_id);
                        localStorage.setItem('i', result.data.id);
                    }

                    history('#/dashboard');

                }
            },
            error : function (data) {
                console.log('>>>>>>>>>> ERROR', data);
                $('.errormsg').removeClass('hide');
                $('.fields').removeClass('hide');
                $('.loader').addClass('hide');
            }
        });
    });

    $(document).on('click', '.logout', function () {  //[~ LOGOUT]
        setCookie('s', false, -190);
        setCookie('t', false, -190);
        setCookie('b', false, -190);
        setCookie('i', false, -190);
        setCookie('access', false, -190);
        setCookie('active', false, -190);
        localStorage.clear();

        history('#/login');
    });

    $(document).on('click', 'body', function () {  //[~ UPDATE SESSION]
        if (checkCookie('active')) {
            var i = getCookie('i');
            var p = getCookie('p');
            setCookie('active', true, 1/48);
            setCookie('i', i, 1/48);
            setCookie('p', p, 1/48);   
        }
    });

    $(document).on('click', '#property-list tbody tr', function () {
        var p = $(this).find('div').attr('id');
        setCookie('p', p, 1/48);
        history('#/property/details');
    });

    function isValidObj (obj) {  //[~ OBJECT VALIDATION]
        var pass = false;
        $.each(obj, function (i, field) {
            if (typeof field !== 'undefined' && field.trim() !== '' && field !== null) { 
                console.log(field);
                pass = true; 
            }
        });

        if (pass) { console.log('Valid Object'); }
        else { console.log('Invalid Object'); }

        return pass;
    }

    $(document).on('change', '.status', function () {
        switch ($(this).val()) {
            case "SOLD":
            case "RENTED":
                $('.list_price').addClass('required');
                break;
            default:
                $('.list_price').removeClass('required');
                break;
        }
    });


    $(document).on('click', '.save-user', function () {
        $('.saving-overlay').removeClass('hide');

        var usertype_id = $('.usertype_id').val(),
            agent_id = $('.agent_id').val(),
            user_id = $('.id').val(),
            user = {};

        $.each($('.user'), function (i, field) {
            var attr = $(field).attr('data-attr-name');

            if (attr === 'username') {
                user[attr] = $('.first_name').val().split(' ').join('') + 'user'; 
            } else {
                user[attr] = $(field).val();
            }
        });

        if (noDefaults('.user-wrapper') && agent_id === 'default' && (user_id === '-9999' || user_id === "")) {
            console.log('create new user...');

            if (user.password === user.retype && user.password != "") {
                console.log('password good');
                saveUser(user, '/user/add');
            } else {
                $('.password, .retype').addClass('empty');
            }

        } else if (agent_id !== 'default' && user_id === '-9999' || user_id !== '-9999') {
            console.log('update existing user....');
            saveUser(user, '/user/update/' + (agent_id !== 'default' ? agent_id : user_id));
        }

        $('.saving-overlay').addClass('hide');
        console.log(user);
    });

    function saveUser (user, url) {
        console.log('>>>>>> USER: ', user, url);

        $.ajax({
            type: 'POST',
            dataType : "json",
            contentType: "application/json; charset=utf-8",
            data : JSON.stringify(user),
            url: url,
            success : function (result) {
                console.log('>>>>>>>>>>>> RESULT', result);

                $('.message-success').addClass('open');

                if (url === '/user/add') {
                    $('.message-success .create').removeClass('hide');
                    $('.message-success .update').addClass('hide');
                } else {
                    $('.message-success .update').removeClass('hide');
                    $('.message-success .create').addClass('hide');
                }

                window.setTimeout(function () {
                    $('.message-success').removeClass('open');
                }, 1000);

                if (result.status === 201 || result.status === 200) {
                    var _id = result.request.id;
                    $('.id').val(_id);
                }
                $('.saving-overlay').addClass('hide');
            },
            error : function (data) {
                console.log('An Error has occurred', data);
                $('.saving-overlay').addClass('hide');

                $('.message-error').addClass('open');

                if (url === '/user/add') {
                    $('.message-error .create').removeClass('hide');
                    $('.message-error .update').addClass('hide');
                } else {
                    $('.message-error .update').removeClass('hide');
                    $('.message-error .create').addClass('hide');
                }

                window.setTimeout(function () {
                    $('.message-error').removeClass('open');
                }, 1000);
            }
        });
    }

    $(document).on('click', '.add', function (e) {
        e.preventDefault();

        var hash = window.location.hash,
            newHash = hash === '#/property' || hash === '#/property/details' ? '#/property' : '#/user';
        window.location.reload();
        history(newHash);
    });

    $(document).on('click', '.save-property-full', function () {
        $('.saving-overlay').removeClass('hide');

        if (noDefaults('.properties-wrapper')) {
            var property_id = $('.property_id').val(),
                property_url = '/insert/property',
                owner_url = '/owners',
                property = {},
                owner = {};

            var owner_id = $('.owner_id').val();
                
            property_url += property_id != -9999 ? '/' + property_id + '/update' : '';
            owner_url += owner_id != -9999 ? '/' + owner_id + '/update' : '';


            $.each($('.property'), function (i, field) {
                var attr = $(field).attr('data-name');

                if (attr === 'is_agent') {
                    property[attr] = 1;
                } else if (attr === 'agent_id') {
                    property['user_id'] = $(field).val() === 'default' ? $('.user_id').val() : $(field).val();
                } else if (attr === 'owner_id') {
                    property['owner_id'] = $(field).val() === 'default' ? $('.owner_id').val() : $(field).val();
                } else {
                    property[attr] = $(field).val();
                }
                
            });

            $.each($('.owner'), function (i, field) {
                var attr = $(field).attr('data-attr-name');
                owner[attr] = $(field).val();
            });

            console.log('>>>>>>>>>>>> PROPERTY OBJECT', property, property_url);
            console.log('>>>>>>> OWNER OBJECT', owner);

            if (isValidObj(owner)) {
                $.ajax({
                    type: 'POST',
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(owner),
                    url: owner_url,
                    success : function (result) {
                        console.log('>>>>>>>>>> RESULT', result);

                        if (result.status === 201 || result.status === 200) {
                            var _id = result.request.id;
                            $('.owner_id').val(_id);
                            property.owner_id = _id;

                            $.ajax({
                                type: 'POST',
                                dataType : "json",
                                contentType: "application/json; charset=utf-8",
                                data : JSON.stringify(property),
                                url: property_url,
                                success : function (result) {
                                    console.log('>>>>>>>>>>>> RESULT', result);

                                    if (result.status === 201 || result.status === 200) {
                                        var _id = result.request.id;
                                        $('.property_id').val(_id);
                                        checkLevels(_id);
                                    }
                                },
                                error : function (data) {
                                    console.log('An Error has occurred', data);
                                    $('.saving-overlay').addClass('hide');
                                }
                            }); 
                        } else if (result.status === 500) {
                            $('.'+result.field).addClass('empty');
                            alert(result.message);
                        }

                        $('.saving-overlay').addClass('hide');
                    },
                    error : function (data) {
                        console.log('An Error has occurred', data);
                        $('.saving-overlay').addClass('hide');
                    }
                }); 
            } 
            else {
                $.ajax({
                    type: 'POST',
                    dataType : "json",
                    contentType: "application/json; charset=utf-8",
                    data : JSON.stringify(property),
                    url: property_url,
                    success : function (result) {
                        console.log('>>>>>>>>>> RESULT', result);

                        if (result.status === 201 || result.status === 200) {
                            var _id = result.request.id;
                            $('.property_id').val(_id);
                            checkLevels(_id);
                        } else if (result.status === 500) {
                            $('.'+result.field).addClass('empty');
                            alert(result.message);
                        }
                        $('.saving-overlay').addClass('hide');
                    },
                    error : function (data) {
                        console.log('An Error has occurred', data);
                        $('.saving-overlay').addClass('hide');
                    }
                }); 
            }
        } else {
            $('.saving-overlay').addClass('hide');
        }
    });

    function checkLevels (id) {
        var lvl1 = $('.row1'),
            lvl2 = $('.row2'),
            lvl3 = $('.row3'),
            lvl4 = $('.row4'),
            lvl5 = $('.row5');

        saveExistingLvl(lvl1, id, 1);
        saveExistingLvl(lvl2, id, 2);
        saveExistingLvl(lvl3, id, 3);
        saveExistingLvl(lvl4, id, 4);
        saveExistingLvl(lvl5, id, 5);
    }

    function saveExistingLvl (lvl, id, index) {
        var level_id = $('.row' + index + '.level_id').val(),
            level_url = '/level',
            level = {},
            exists = false;

        level_url += level_id == -9999 ? '' : '/' + level_id + '/update';

        $.each(lvl, function (i, field) {
            var attr = $(field).attr('data-name');
            level[attr] = $(field).val();

            if ($(field).val() !== '' && $(field).val() != -9999) {
                exists = true;
            }
        });

        if (exists) {
            level['property_id'] = id;
            $.ajax({
                type: 'POST',
                dataType : "json",
                contentType: "application/json; charset=utf-8",
                data : JSON.stringify(level),
                url: level_url,
                success : function (result) {
                    console.log('>>>>>>>>>> RESULT', result);
                    $('.saving-overlay').addClass('hide');
                },
                error : function (data) {
                    console.log('An Error has occurred', data);
                    $('.saving-overlay').addClass('hide');
                }
            });
        } else {
            $('.saving-overlay').addClass('hide');
        }
    }

    function noDefaults (selector) {
        var attr = $(selector + ' .required'),
            defaults = true;

        $.each(attr, function (i, field) {
            if ($(field).val() === "" || $(field).val() === 'default') {
                $(field).addClass('empty');
                defaults = false;
            } else {
                $(field).removeClass('empty');
            }
        });
        return defaults;
    }

    function loadOwners () {  //[~ OWNERS LOADER]
        $.get('/owners').done(function (data) {
            console.log('>>>>>>>> OWNERS', data);
            var ownerlist = $('.existing-owners');
            ownerlist.find("option:gt(0)").remove();

            $.each(data, function (i, field) {
                var opt = $('<option>', {
                    'value': field.id, 
                    'text': (field.name ? 'Owner: ' + field.name : '') +
                            (field.contact ? ' C: ' + field.contact : '') +
                            (field.primary_phone ? ' P1: ' + field.primary_phone : '') +
                            (field.secondary_phone ? ' P2: ' + field.secondary_phone : '') +
                            (field.email ? ' E: ' + field.email : '') +
                            (field.contact_phone ? ' CP: ' + field.contact_phone : '') +
                            (field.contact_email ? ' CE: ' + field.contact_email : '')
                });
                ownerlist.append(opt);
            });

            $('.owner .loader-gif').addClass('hide');
            ownerlist.prop('disabled', false);
        });
    }

    function loadAgents () {  //[~ AGENTS LOADER]
        $.get('/user').done(function (data) {
            console.log('>>>>>>>> OWNERS', data);
            var ownerlist = $('.existing-owners');
            ownerlist.find("option:gt(0)").remove();

            $.each(data, function (i, field) {
                var opt = $('<option>', {
                    'value': field.id, 
                    'text': (field.name ? 'Owner: ' + field.name : '') +
                            (field.contact ? ' C: ' + field.contact : '') +
                            (field.primary_phone ? ' P1: ' + field.primary_phone : '') +
                            (field.secondary_phone ? ' P2: ' + field.secondary_phone : '') +
                            (field.email ? ' E: ' + field.email : '') +
                            (field.contact_phone ? ' CP: ' + field.contact_phone : '') +
                            (field.contact_email ? ' CE: ' + field.contact_email : '')
                });
                ownerlist.append(opt);
            });

            $('.owner .loader-gif').addClass('hide');
            ownerlist.prop('disabled', false);
        });
    }

    function loadListTypes () {} // to be loaded dynamically 

    function loadPropertyTypes () {} // to be loaded dynamically

    function loadZones () {} // to be loaded dynamically

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie(tag) {
        var tag = getCookie(tag);
        return tag !== "" ? true : false;
    }

    function login () {
        if (checkCookie('s') && checkCookie('t')) {
            var check = {
                s: getCookie('s'),
                t: getCookie('t')
            }

            // $.ajax({
            //     type: 'POST',
            //     dataType : "json",
            //     contentType: "application/json; charset=utf-8",
            //     data : JSON.stringify(check),
            //     url: '/user/persists',
            //     success : function (result) {
                       
            //     }
            // });
            return true;

        } else if (getCookie('active')) {
            return true;
        }
        return false;
    }


    function loadLogin () {
        $.get('./js/pages/login.html', function (data) {
            $('body').attr({ 'class': 'login' });
            $('.app').html(data);
        });
    }

    function loadUser () {
        if (login()) {
            var promise = $.get('./js/pages/dashboard.html').then(function (data) {
                $('body').attr({ 'class': 'dashboard' });
                $('.app').html(data);

                var i = getCookie('i'),
                    b = localStorage.getItem('b');

                if (getCookie('access') == 1 || getCookie('access') == 2) {
                    var opt = '<li class="nav nav-user"><a href="#/user">User</a></li>';
                    $('.creation-list').append(opt);
                }

                $('.user_id').val(i);
                $('#broker').val(b);

                return $.get('./js/pages/user.html', data);
            }).then(function (data) {
                $('.properties-wrapper').html(data);
                $('.nav a').removeClass('active');
                $('.nav-user a').addClass('active');
            });
        } else {
            history('#/login');
        }
    }

    function loadProperty () {
        if (login()) {
            var promise = $.get('./js/pages/dashboard.html').then(function (data) {
                $('body').attr({ 'class': 'dashboard' });
                $('.app').html(data);

                var i = getCookie('i');
                $('.user_id').val(i);

                if (getCookie('access') == 1 || getCookie('access') == 2) {
                    var opt = '<li class="nav nav-user"><a href="#/user">User</a></li>';
                    $('.creation-list').append(opt);
                }

                return $.get('./js/pages/property-spec.html', data);
            }).then(function (data) {
                $('.properties-wrapper').html(data);
                $('.nav a').removeClass('active');
                $('.nav-property a').addClass('active');
            });
        } else {
            history('#/login');
        }
    }

    function loadPropertyDetails () {  //[~ PROPERTY DETAILS LOADER]
        if (login()) {
            var id = getCookie('p'),
                promise = $.get('./js/pages/dashboard.html').then(function (data) {
                    $('body').attr({ 'class': 'dashboard' });
                    $('.app').html(data);

                    var i = getCookie('i');
                    $('.user_id').val(i);

                    if (getCookie('access') == 1 || getCookie('access') == 2) {
                        var opt = '<li class="nav nav-user"><a href="#/user">User</a></li>';
                        $('.creation-list').append(opt);
                    }

                    return $.get('./js/pages/property-spec.html', data);
                }).then(function (data) {
                    $('.properties-wrapper').html(data);
                    $('.nav a').removeClass('active');
                    $('.nav-property a').addClass('active');


                    $.get('/insert/property/' + id).done(function (data) {
                        console.log('>>>>>>>> Property', data);

                        var access = localStorage.getItem('access'),
                            broker = data.broker_id,
                            user = data.user_id;

                        console.log('>>>>>>>>>>> ACCESS', access, broker, user, '|', localStorage.getItem('b'), localStorage.getItem('i'));
                        if (localStorage.getItem('access') == 1) {
                            console.log('access = 1');
                            $('.property-entry input, .property-entry select, .property-entry textarea').prop("disabled", false);
                            $('.owner-wrapper').removeClass('hide');
                        } else if (broker === localStorage.getItem('b') && localStorage.getItem('access') == 2) {
                            console.log('access = 2 + broker');
                            $('.property-entry input, .property-entry select, .property-entry textarea').prop("disabled", false);
                            $('.owner-wrapper').removeClass('hide');
                        } else if (broker === localStorage.getItem('b') && user === localStorage.getItem('i')) {
                            console.log('broker + user');
                            $('.property-entry input, .property-entry select, .property-entry textarea').prop("disabled", false);
                            $('.owner-wrapper').removeClass('hide');
                        } else {
                            console.log('no access, or user');
                            $('.property-entry input, .property-entry select, .property-entry textarea').prop("disabled", true);
                            $('.owner-wrapper').addClass('hide');
                        }


                        $.each(data, function (i, field) {

                            switch (i) {
                                case 'owner_id':
                                    $('.' + i).val(field);
                                    $('.select-owner').change();
                                    break;
                                case 'ltype_id':
                                    console.log('>>>>>>>>>>>>> LIST');
                                    $('.ltype_id').val(field);
                                    $('.ltype_id').change();
                                    break;
                                case 'user_id':
                                    $('.agent_id').val(field);
                                    break;
                                case 'id':
                                    $('.property_id').val(field);
                                    break;
                                default:
                                    $('.' + i).val(field);
                            }
                            
                            // if (i === 'ltype_id') {
                            //     console.log('>>>>>>>>>>>>> LIST');
                            //     $('.ltype_id').val(field);
                            //     $('.ltype_id').change();
                            // } 

                            // else if (i === 'id') {
                            //     $('.property_id').val(field);
                            // }

                            // else if (i === 'user_id') {
                            //     $('.agent_id').val(field);
                            // }

                            // else if (i === 'owner_id') {
                            //     $('.select-owner').change();
                            // }

                            // else {
                            //     $('.' + i).val(field);
                            // }


                        });
                    });

                    $.get('/level/get/' + id).done(function (data) {
                        var row = data.request;

                        $.each(row, function (i, field) {
                            var index = i + 1;
                            console.log(i, field);
                            $('.row' + index).removeClass('hide');
                            $('.row' + index + '.id').val(field.id)
                            $('.row' + index + '.level').val(field.level)
                            $('.row' + index + '.net_internal').val(field.net_internal)
                            $('.row' + index + '.rentable').val(field.rentable)
                            $('.row' + index + '.gross').val(field.gross)
                            $('.row' + index + '.rent_psf').val(field.rent_psf)
                        });
                    });

                });
        } else {
            history('#/login');
        }
    }

    function loadDashboard () {
        setCookie('p', false, -190); 

        if (login()) {
            var promise = $.get('./js/pages/dashboard.html').then(function (data) {
                $('body').attr({ 'class': 'dashboard' });
                $('.app').html(data);

                var i = getCookie('i');
                $('.user_id').val(i);

                if (getCookie('access') == 1 || getCookie('access') == 2) {
                    var opt = '<li class="nav nav-user"><a href="#/user">User</a></li>';
                    $('.creation-list').append(opt);
                }

                return $.get('./js/pages/property-list.html', data);
            }).then(function (data) {
                $('.properties-wrapper').html(data);

                if ( $.fn.dataTable.isDataTable( '#property-list' ) ) {
                    var table = $('#property-list').DataTable();
                }
                else {
                    $.get('/property/list').done(function (data) {
                        console.log('>>>>>> Properties', data);

                        var table = $('#property-list').DataTable( {
                            "data": data,
                            "columns": [
                                {
                                    data: 'id',
                                    render: function (data, type, row) {
                                        return '<div id="' + data + '">' + data + '</div>';
                                    }
                                },
                                {data: 'listing_no'},
                                {data: 'list_type'},
                                {data: 'property_type'},
                                {
                                    data: 'status',
                                    render: function (data, type, row) {
                                        return data.toString() === 'OFF_MARKET' ? 'OFF MARKET' : data.toString();
                                    }
                                },
                                {data: 'zone'},
                                {
                                    data: 'list_price',
                                    render: function (data, type, row) {
                                        if (data !== null ) {
                                            return '$ ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        }
                                        return "$";
                                    }
                                }
                            ]
                        } );
                    });

                    $('.nav a').removeClass('active');
                    $('.nav-dashboard a').addClass('active');
                }
            });

        } else {
            history('#/login');
        }
    }

    function route () {
        switch (window.location.hash) {
            case '':
            case '#/':
            case '#/login':
                console.log('Login', getCookie('active'));
                if (!login()) {
                    loadLogin();
                } else {
                    history('#/dashboard');
                }
                break;
            case '#/dashboard':
                if (login()) {
                    loadDashboard();
                } else {
                    history('#/login');
                }
                break;
            case '#/property':
                console.log('Property', getCookie('active'));
                if (login()) {
                    loadProperty();
                } else {
                    history('#/login');
                }
                break;
            case '#/property/details':
                console.log('Property Details', getCookie('active'));
                if (login()) {
                    loadPropertyDetails();
                } else {
                    history('#/login');
                }
                break;
            case '#/user':
                console.log('User', getCookie('active'));
                if (login()) {
                    loadUser();
                } else {
                    history('#/login');
                }
                break;
        }
    }

    function history (hash) {
        if (history.pushState) {
            history.pushState(null, null, hash);
        } else {
            window.location.hash = hash;
        }
    }

    $(window).on('hashchange', function () {
        route();
    });

    $(document).ready(function () {
        route();
    }); 
	
}(this));