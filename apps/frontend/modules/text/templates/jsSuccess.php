<?php include_component('text', 'js') ?>

// main
var ap_stopAll = function(){};
//var audioplayer  = false;
// здесь запоминается форма Предложить перевод, чтобы после подгрузки фото, её восстанавливать
//var page_toolbar_clone  = '';
// позиция в окне перед активацией одной из кнопок панели инструментов
var page_toolbar_window_pos  = 0;
// интервал показа цитат
//var rotate_quotes_interval  = 15000;
// номер последней показанной цитаты
//var last_quote_index  = -1;
// минимальный размер окна, при котором скрываются элементы
var window_size_hide_el  = 1000;
// ссылки на фото преобразованы
var ph_links_ready = false;
// ссылка на текущую фотографию
var global_photo_href;
// режим отображения страницы
var page_mode = '';
// режим отображения страницы до открыти всплывающего окна
var prev_page_mode = '';
// минимальная ширина фото во всплывающем окне
var min_photo_full_width = 566;
// минимальная высота фото во всплывающем окне
var min_photo_full_height = 300;
// отступы при вычислении размеров всплывающего окна
var p_cb_horiz_margin = 50;
var p_cb_vert_margin  = 80; // только снизу
var p_cb_horiz_padding = 50;
var p_cb_vert_padding  = 0;
// вертикальную позицию в окне
var cb_window_pos = 0;
// период вызова resize всплывающего окна
var cb_resize_period = 200;
// пространство, изначально выделяемое для комментариев
//var cb_comments_height = 398;
var cb_comments_height = 0;
// после открытия resize всплывающего окна ещё не делаллся
var cb_first_resize = true;
// URL до открытия всплывающего окна
var cb_prev_url = "";
// заголовок страницы до открытия всплывающего окна
var cb_prev_title = "";
// всплывающее окно было открыто на странице с фото
var cb_from_photo_page = false;
// адрес страницы для страницы комментариев до открытия всплывающего окна
var cb_prev_dusqus_url = '';
var cb_prev_disqus_identifier = '';
// циклический ресайз после открытия фото во всплывающем окне
var first_cyclic_resize = true;
// content list of the album
var album_content = {};
// photo is being loaded
var loading_photo = false;
// url and size of the photos
var photo_preview_info = [];
var photo_full_info = [];
// calculated width and height of the photo in Colorbox
var new_photo_width;
var new_photo_height;
// number of photos in carousel
var carousel_photo_count =7;

$(document).ready(function() {
    var embedded_or_print = false;
    var hash = window.location.hash;
    
    loadPhotoContentFromHash();
    
    page_mode = hash.substring(1);
    
    //if (page_mode == 'enlarge_photo') {
    //    // увеличенное фото
    //    $("body").addClass("enlarge_photo");
    //    return;
    //} else {
    // страница встроена
    if (top !== self) { 
        $("body").addClass("embedded");
        page_mode = "embedded";
        embedded_or_print = true;
    }
    // версия для печати
    if (page_mode == "print_version") {
        $("body").addClass("print_version");
        embedded_or_print = true;
    }
    if (embedded_or_print) {
        // сообщение о том, что страница встроена
        // путь без параметров и хэша 

        var embed_source = window.location + "";
        //embed_source = embed_source.substring(0, embed_source.indexOf('#'));
        //embed_source = embed_source.substring(0, embed_source.indexOf('?'));
        embed_source = embed_source.replace(/([^#?]+)[#?]?.*/g, "$1");

        $("#content").append('<p class="small"><?php echo __("Source") ?>: <br/><a href="' + embed_source + '">' + embed_source + '</a></p>');
        return;
    }
    //}

    // сокрытие элементов в зависимости от размера окна
    onWindowResize();

    // цитаты отображаются, если есть перевод и размер окна больше минимального
    //if (quote_list) {
    //    showQuotes();        
    //}
    
    // random audio   
    /*if (audio_list) {
        var audio_index = Math.floor(Math.random( ) * (audio_list.length));
        if (audio_list[ audio_index ]) {
            $("#mp3").attr("title", audio_title_list[ audio_index ] );
            $("#mp3 span").html( audio_list[ audio_index ] );
        }
    }    
    
	// custom options
	$("#mp3").jmp3({
		//filepath: "http://etapasvi.zxq.net/"
		//filepath: "http://www.etapasvi.com/uploads/audio/",
		filepath: "http://k002.kiwi6.com/uploads/hotlink/",
        width: 24
	});*/

	// select language
	//$("span.lang_selector").colorbox({inline:true, fixed:true, href:"#lang_box", opacity:"0.5", transition:"none", close:"X"});

    // перемещение Предложения перевода наверх

    //$("#page_toolbar").insertAfter( "#content h1:eq(0)" );        
    
    // текст в футере
    if (footer_text) {
        $("#lang_plain").after(footer_text);
    }   
    
    // сокрытие элементов в зависимости от размера окна
    $(window).resize(function() {
        onWindowResize();
    });
    
    // всплывающие названия языков
    $("#lang_column a, #lang_column strong").tipsy({gravity: 's', opacity:1});

    // быстрый поиск
    $("#quick_search_input").focus(function() {
        $(this).addClass('focused');
    });
    $("#quick_search_input").focusout(function() {
        setTimeout('$("#quick_search_input").removeClass("focused")', 200);
    });
});

// сокрытие элементов в зависимости от размера окна
function onWindowResize() 
{

    if (!$("body").hasClass('direction_rtl')) {
        // left aligned text
        if ($(window).width() < window_size_hide_el) {
            $("#wrapper").css('margin-left', '70px');
        } else {
            $("#wrapper").css('margin-left', 'auto');
        }        
    } else {
        // right aligned text
        if ($(window).width() < window_size_hide_el) {
            $("#wrapper").css('margin-right', '70px');
        } else {
            $("#wrapper").css('margin-right', 'auto');
        } 
    }

    // если просматриваем фото
    if (page_mode == 'enlarge_photo') {
        // если в функции сделать alert, Mozilla зависает
        resizePhotoColorbox();
        cbResize();
    }
}

// скрывает цитату
/*function hideQuotes()
{
    // fadeOut для элемента p вешает IE    
    $("#quote_p_cont").fadeOut(600);
    setTimeout( showQuotes, 700);
}*/

// отображает случайную цитату
/*
function showQuotes()
{
    // если размер окна удовлетворяет, показываем цитату    
    if ($(window).width() > window_size_hide_el) {
        var quote_el = $("#bubble_quote p:first");    
        var quote_index = Math.floor(Math.random( ) * (quote_list.length));
        // если выбрана прошлая цитата, берём предыдущую в списке или последнюю
        if (quote_index == last_quote_index) {
            if (quote_index > 1) {
                quote_index = quote_index - 1;
            } else {
                quote_index = quote_list.length - 1;
            }
        }
        
        last_quote_index = quote_index;
        if (quote_list[ quote_index ]) {
            quote_el.html( quote_list[ quote_index ]);
        }        
        $("#quote_p_cont").fadeIn(600);
    }
    setTimeout( hideQuotes, rotate_quotes_interval);
}*/

// исходный текст учения
function showOriginal() 
{
	if ( $("#elOriginal").is(":hidden") ) {
		$("#elOriginal").slideDown("slow");
	} else {
		$("#elOriginal").slideUp("slow");
	}
}

// текст аудиозаписи
function showAudioBody(id) 
{    
    var element_id = "#elAudioBody" + id;

	if ( $(element_id).is(":hidden") ) {
		$(element_id).slideDown("fast");
	} else {
		$(element_id).slideUp("fast");
	}
}

//  модификация ссылок для подгрузки содержимого
function preparePhotoContent()
{    
    $(document).ready(function() {
        // если фото открыто во всплывающем окне в iframe
        if (page_mode == "enlarge_photo") {
            var full_photo_img = $("#colorbox img.full_photo_img");            
            // замена превью на полную версию фото
            //full_photo_img.attr("src", $("#photo_full_url").val());
            resizePhotoColorbox(full_photo_img);
            // align loader in the middle of the photo and show it
            $("#colorbox #photo_content .prev_next a").css('visibility', 'hidden');
        }        
        
        // title
        var content_title = $("#photo_content_title").text();

        if (content_title) {
            document.title = unescapeHTML(content_title);
        }

        // преобразование ссылок на предыдущую и следующую фото
        /*var href;
        $("#photo_content a.photo_content_link").each(function(index) {
            href = $(this).attr('href');

            href = "javascript: loadPhotoContent('" + href + "'); void(0)";
            $(this).attr('href', href);
        });*/
    });
}

// преобразование HTML-сущностей в их печатные аналоги
function unescapeHTML(html) {
   return $("<div />").html(html).text();
}

// подгонка размера фото
function resizePhotoColorbox(full_photo_img)
{
    if (!full_photo_img) {
        full_photo_img = $("#colorbox img.full_photo_img");
    }

    // установка размера фото, контейнеров и всплывающего окна
    // размеры окна
    var w_width  = $(window).width() * 1;
    var w_height = $(window).height() * 1;
    // размеры фото
    var p_width  = photo_full_info['width'] * 1;
    var p_height = photo_full_info['height'] * 1;

    // подобранные размеры
    var rect_width;
    var rect_height;

    // Подбор ширины и высоты области с фото (rect_):
    // Если размер фото меньше минимально допустимого или размер окна меньше минимально допустимого
    // размер области устанавливается равным минимально допустимому.
    // Если размер фото больше размера окна, устанавливаем размер области равным размеру окна.
    // Иначе размер области устанавливается равным размеру фото
    if (p_width > min_photo_full_width && w_width > min_photo_full_width + p_cb_horiz_margin) {
        if (p_width > (w_width - p_cb_horiz_margin - p_cb_horiz_padding) ) {
            rect_width = w_width - p_cb_horiz_margin;
        } else {
            rect_width = p_width + p_cb_horiz_padding;
        }
    } else {
        rect_width = min_photo_full_width;
    }
    if (p_height > min_photo_full_height && w_height > min_photo_full_height + p_cb_vert_margin) {
        if (p_height > (w_height - p_cb_vert_margin - p_cb_vert_padding) ) {
            rect_height = w_height - p_cb_vert_margin;
        } else {
            rect_height = p_height;
        }
    } else {
        rect_height = min_photo_full_height;
    }   

    // пропорционально изменяем размеры фото    
    p_width     += 0.0;
    p_height    += 0.0;
    rect_width  += 0.0;
    rect_height += 0.0;

    new_photo_width  = rect_width - p_cb_horiz_padding;
    new_photo_height = rect_height - p_cb_vert_padding;

    if ( (p_width / p_height) > (new_photo_width / new_photo_height) ) {
        // уменьшаем высоту       
        new_photo_height = Math.floor( (p_height * new_photo_width) / p_width );        
    } else {
        // уменьшаем ширину
        new_photo_width  = Math.floor( (p_width * new_photo_height) / p_height );        
    }

    if (new_photo_height > p_height) {
        new_photo_height = p_height;
    }

    if (new_photo_width > p_width) {
        new_photo_width = p_width;
    }
    
    // устанавливаем размеры области после пересчёта размера изображения
    // если одна из сторон получилась меньше минимальной, устанавливаем равной минимальной 
    rect_height = new_photo_height + p_cb_vert_padding;
    if (rect_height < min_photo_full_height) {
        rect_height = min_photo_full_height;
    }    
    rect_width  = new_photo_width + p_cb_horiz_padding;
    if (rect_width < min_photo_full_width) {
        rect_width = min_photo_full_width;
    }

    // после открытия colorbox считывает размеры содержимого
    $("#photo_content").css( {"width": rect_width/*, "height": rect_height*/} );
    // шириной фото руководит родительский элемент
    full_photo_img.css( {"max-width": new_photo_width/*, "height": new_photo_height*/} );
    //$("#colorbox a.photo_frame").css( {"width": (rect_width - p_cb_horiz_padding)} );

    cb_width = rect_width+p_cb_horiz_margin;
    cb_height = rect_height+cb_comments_height;
    
    first_cyclic_resize = true;
    
    cbResize();    
}

// установка размеров всплывающего окна
// необходимо вызывать resize с явно указанными размерами, 
// т.к. после открытия colorbox больше не считывает размеры содержимого
function cbResize(scroll_to_pos)
{    
    $("#colorbox #photo_content .prev_next a").css('visibility', 'visible');

    if (page_mode != "enlarge_photo") {
        return;
    }
    // первый вызов после открытия всплывающего окна пропускаем
    // т.к. после открытия колорбокс сам делает ресайз
    if (cb_first_resize) {
        cb_first_resize = false;
        // webkit-браузеры при окрытии всплывающего окна выставляют высоту не по контенту, а по своему усмотрению
        // если вызвать ресайз через какое-то время, высота будет подобрана верно
        
        if ($.browser.webkit) {
            setTimeout(function(){ cbResize(); }, cb_resize_period);
        } else {
            return;
        }
    } else {
        // если высота всплывающего окна удовлетворительная, выходим
        // иначе вызываем ресайз высплывающего окна
        if (!first_cyclic_resize && $("#cboxLoadedContent").height() >= cb_height) {
            first_cyclic_resize = false;
            return;
        }
    }
    /*if (!cb_width) {
        setTimeout(function(){ cbResize(); }, cb_resize_period);
        return;
    } */
    //if (!no_scroll_to_top) {
    //$(window).scrollTop(0);
    //}

    $.colorbox.resize({width: cb_width});
    // прокручиваем окно к указанной позиции    
    if (typeof scroll_to_pos != "undefined") {
        $(window).scrollTop(scroll_to_pos);
    }
    
    // функция ресайза запускается до тех пор, пока высота всплывающего окна не будет адекватной
    setTimeout(function(){ cbResize(); }, cb_resize_period);
    first_cyclic_resize = false;    
    
    switchBetweenFullAndPreview();
}

//  модификация ссылок на фотографии (не испольузется)
function phLinks()
{    
    if (ph_links_ready) {
        return ph_links_ready;
    }    
    $(document).ready(function(){
        var href;
        $("#content a.ph_link").each(function(index) {
            href = $(this).attr('href');

            href = "javascript: enlargePhoto('" + href + "#enlarge_photo'); void(0)";
            $(this).attr('href', href);
        });
    });
    ph_links_ready = true;
}

// подгрузка содержимого фото
function enlargePhoto(href, from_photo_page, photoalbum_id, parent_el)
{
    if (!photoalbum_id) {
        document.location = href;
        return;
    }

    // запоминается режим, чтобы после закрытия всплывающего окна, восстановить
    prev_page_mode = page_mode;
    page_mode      = 'enlarge_photo';
    
    // фото было увеличено со страницы фотографии
    if (from_photo_page) {
        cb_from_photo_page = true;
    } else {
        cb_from_photo_page = false;
    }
    
    // запоминаем вертикальную позицию в окне
    //cb_window_pos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop;
    cb_window_pos   = $(window).scrollTop();
    if (cb_window_pos) {
        // фиксируем позицию и устанавливаем высоту контейнера страницы
        $("#wrapper").css({"top": (cb_window_pos*(-1))});
        $(window).scrollTop(0);
    }   
    
    // устанавливаем URL страницы
    cb_prev_url = document.location + "";
    setUrl(href);
    
    // запоминаем адрес страницы для скрипта комментариев
    if (typeof disqus_url != "undefined") {
        cb_prev_dusqus_url        = disqus_url;
        cb_prev_disqus_identifier = disqus_identifier;
    }
    cb_prev_title = document.title + "";
    
    cb_first_resize = true;       

    var small_photo_src = $(parent_el).find('img').attr('src');
    var colorbox_html = '<div id="photo_content"><div class="center" ><img src="/i/jquery/colorbox/loading.gif" style="margin:85px 0"></div></div>';

    $.colorbox({
//        href:getContentUrl(href),
        html: colorbox_html,
        initialWidth: min_photo_full_width,
        initialHeight: min_photo_full_height,
        width: min_photo_full_width + 'px',
        height: min_photo_full_height + 'px',
//        top:"0px",
        opacity:"0.5",
        close:"X",
        scrolling: "visible",
        transition: "none",
        speed: 0,
        onClosed: function () {
            if (cb_from_photo_page) {
                window.location.href = cb_prev_url;
            }
        
            // восстанавливаем размер и позицию основного контейнера страницы
            $("#wrapper").css({"top": 0});
            $(window).scrollTop(cb_window_pos);            
            cb_from_photo_page
            // устанавливаем URL, который был до открытия колорбокса
            if (cb_prev_url) {
                setUrl(cb_prev_url, true);
                cb_prev_url = "";
            }
            
            if (cb_prev_title) {
                document.title = cb_prev_title;
                cb_prev_title = "";
            }
            
            // в IE изменение адресной строки прокручивает окно наверх
            $(window).scrollTop(cb_window_pos);

            // восстанавливаем комментарии на основной странице
            //eval( $("#disqus_config_script").text() );   
            disqus_url        = cb_prev_dusqus_url;
            disqus_identifier = cb_prev_disqus_identifier;
            
            if (disqus_url) {
                $("#disqus_thread").html(
                    "<script type=\"text/javascript\">" +
                    $("#disqus_config_script").text() +        		
                    //"var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true; " +
                    //"dsq.src = $(\"#disqus_script\").attr(\"src\"); " +
                    //"(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq); " + 
                    "</script>"
                );
                // в IE обработка скрипта работает с небольшой задержкой, поэтому скрипт disqs надо подключать немного погодя
                // при динамической вставке disqus как script в DOM сыпятся ошибки
                //if ($.browser.msie) {
                    //setTimeout(function() {
                        //$("#disqus_thread").html(
                        //    "<script src=\"" + $("#disqus_script").attr("src") + "\" type=\"text/javascript\"></script>"
                        //);
                    //}, 1000);
                //} else {
                $("#disqus_thread").html(
                    "<script src=\"" + $("#disqus_script").attr("src") + "\" type=\"text/javascript\"></script>"
                );			
                //}
            }
            page_mode           = prev_page_mode;
            prev_page_mode      = '';
            cb_window_pos       = 0;
            cb_prev_dusqus_url  = '';
            cb_prev_disqus_identifier  = '';
        },
        onComplete: function () {
            // перемещаем page_toolbar из основной страницы во всплывающее окно
            //$("#page_toolbar").insertAfter("#dsq-brlink");            
            //$("#page_toolbar").insertAfter("#dsq-brlink");            
        }
    });
    
    //var photo_id = getPhotoIdFromUrl(href);    
    //var photo_html = getPhotoHtml(photo_id, photoalbum_id);
    
    // load photo into opened colorbox    
    loadPhotoContent(href, photoalbum_id);
}

// get album content
function getPhotoHtml(photo_id, photoalbum_id)
{
    if (typeof album_content[ photoalbum_id ] == "undefined" || typeof album_content[ photoalbum_id ][ photo_id ] == "undefined") {
        var culture = getCultureFromUrl(document.location + "");
        album_content_url = '/' + culture + '/photo/albumcontent/' + photoalbum_id;
        $.ajax({
//            async: false,
            url: album_content_url,
//            dataType: 'json',
            success: function(data) {   
                var re = /<ac_([^>]+)>((?!<\/ac_)[\s\S])+<\/ac_[^>]+>/gm;
                while (matches = re.exec(data)) {
                    if (typeof album_content[ photoalbum_id ] == "undefined") {
                        album_content[ photoalbum_id ] = {};
                    }
                    album_content[ photoalbum_id ][ matches[1] ] = matches[0];
                }
                //album_content[ photoalbum_id ] = data;
            }        
        });
    }

    // if ajax failed, redirect to the photo page    
    if (!album_content[ photoalbum_id ] || !album_content[ photoalbum_id ][ photo_id ]) {
        document.location = href;
    }
    
    return album_content[ photoalbum_id ][ photo_id ];
}

// get photo id from url
function getCultureFromUrl(url)
{
    culture = url.replace(/http:\/\/[^\/]+\/([^\/]+)\/.*/, '$1');
    return culture;
}

// get photo id from url
function getPhotoIdFromUrl(url)
{
    id = url.replace(/http:\/\/[^\/]+\/[^\/]+\/photo\/(\d+)\/?.*/, '$1');
    return id;
}

// получение адреса content фото из полного URL фотографии
function getContentUrl(href)
{
    href = href.replace(/http:\/\/[^\/]+\//, '');
    return '/' + href.replace(/\/photo\//, '/photo/content/');
}

// подгрузка содержимого фото
function loadPhotoContent(href, photoalbum_id, hide_content, domain)
{
    if (!href || loading_photo) {
        return;
    }
    
    // set to 0 after opening comments
    cb_comments_height = 0;
    
    // чтобы при просмотре фотографий, пользователь постепенно не смещался вниз
    // перед отрытием всплывающего окна запоминаем позицию в окне и при переходе по фотографиям,
    // прокручиваем окно к запомненной позиции
    if (page_mode == 'enlarge_photo') {
        //$(window).scrollTop(cb_window_pos);        
        $(window).scrollTop(0);
    }
    
    // получаем домен
    if (!domain) {
        domain = href.replace(/http:\/\/([^\/]+).*/, '$1');
    }
    if (!domain) {
        return;
    }

    // домен не включается
    href = href.replace(/http:\/\/[^\/]+\//, '');

    if (hide_content) {
        $("#photo_content .photofull").html( '<p id="photo_loader" class="hidden center_text" ><img src="/i/jquery/colorbox/loading.gif" /></p>' );
        $("#disqus_thread").hide();
        $("#photo_content div.social").remove();
        $("#photo_content .dsq-brlink").remove();
    }
    global_photo_href = 'http://' + domain + '/' + href;
    
    loading_photo = true;

    // сохраняем форму Предложить перевод
    //$("#offer_tr").hide();
    //page_toolbar_clone = $("#page_toolbar").clone();

    // отправка запроса
    var photo_id = getElementIdFromUrl(global_photo_href)
    /*var photo_html = getPhotoHtml(photo_id, photoalbum_id);
        
    // модификация URL
    setUrl(global_photo_href);

    $("#photo_content").replaceWith(photo_html);
    // восстанавливаем форму Предложить перевод
    //page_toolbar_clone.insertAfter( "#content h1:eq(0)" );      

    // указывается новый URL в форме Предложить перевод
    $("#offer_tr_uri").val(global_photo_href);
    // вытаскивается ID из URL
    $("#offer_tr_id").val(photo_id);*/

    if (typeof album_content[ photoalbum_id ] == "undefined" || typeof album_content[ photoalbum_id ][ photo_id ] == "undefined") {
        var culture = getCultureFromUrl(document.location + "");
        album_content_url = '/' + culture + '/photo/albumcontent/' + photoalbum_id;
        $.ajax({
            url: album_content_url,
            success: function(data) {         
                var re = /<ac_([^>]+)>((?!<\/ac_)[\s\S])+<\/ac_[^>]+>/gm;
                while (matches = re.exec(data)) {
                    if (typeof album_content[ photoalbum_id ] == "undefined") {
                        album_content[ photoalbum_id ] = {};
                    }
                    album_content[ photoalbum_id ][ matches[1] ] = matches[0];
                }
                if (!album_content[ photoalbum_id ] || !album_content[ photoalbum_id ][ photo_id ]) {
                    //document.location = href;
                    return;
                }
  
                setPhotoHtml(album_content[ photoalbum_id ][ photo_id ], photo_id);
            }/*,
            error: function(data) {   
                document.location = href;
            }*/
        });
    } else {
        setPhotoHtml(album_content[ photoalbum_id ][ photo_id ], photo_id);
    }    
    preparePhotoContent();
}

// load photo when we don't know it's album id
function loadPhotoContentByPhotoId(href)
{
    var photo_id        = getPhotoIdFromUrl(href);
    var culture         = getCultureFromUrl(document.location + "");
    var photo_map_url   = '/' + culture + '/photo/map';
    
    if (!photo_id) {
        return;
    }
    $.ajax({
        url: photo_map_url,
        dataType: 'json',
        success: function(data) {    
            var photoalbum_id = '';
            if (typeof data[ photo_id ] != "undefined") {
                photoalbum_id = data[ photo_id ];
            }
            loadPhotoContent(href, photoalbum_id);
        }
    });
}

// set photo HTML 
function setPhotoHtml(photo_html, photo_id)
{

    if (!photo_html) {
        return;
    }
    // модификация URL
    setUrl(global_photo_href);
                 
    // get Preview infoz
    var matches = photo_html.match(/id="photo_preview_info" value="([^"]+)"/g);
    var match_item = "";

    for (i in matches) {
        match_item = matches[ i ] + "";
        // in IE matches containes more elements than in other browsers
        if (match_item.match(/photo_preview_info/)) {
            photo_preview_info_str = match_item;
        }
    }
    if (photo_preview_info_str) {
        photo_preview_info_str = photo_preview_info_str.replace(/id="photo_preview_info" value="/g, '').replace(/"/g, '').replaceAll(/'/, '"');
        photo_preview_info     = $.parseJSON(photo_preview_info_str);
    } else {
        photo_preview_info = [];
    }

    if (isReplaceWithPreviewNeeded()) {
        photo_html = photo_html.replace(/src="([^"]+)" class="full_photo_img"/g, 'src="' + photo_preview_info['url'] + '" class="full_photo_img"');

        // set prev photo to Preview
        if (typeof photo_preview_info['prev_url'] != "undefined") {
            photo_html = photo_html.replace(/src="([^"]+)" id="prev_photo_preview"/g, 'src="' + photo_preview_info['prev_url'] + '" id="prev_photo_preview"');
        }
        // set next photo to Preview
        if (typeof photo_preview_info['next_url'] != "undefined") {
            photo_html = photo_html.replace(/src="([^"]+)" id="next_photo_preview"/g, 'src="' + photo_preview_info['next_url'] + '" id="next_photo_preview"');
        }
    }
    
    // get Full info
    var matches = photo_html.match(/id="photo_full_info" value="([^"]+)"/g);

    for (i in matches) {
        match_item = matches[ i ] + "";
        // in IE matches containes more elements than in other browsers
        if (match_item.match(/photo_full_info/)) {
            photo_full_info_str = match_item;
        }
    }

    if (photo_full_info_str) {
        photo_full_info_str = photo_full_info_str.replace(/id="photo_full_info" value="/g, '').replace(/"/g, '').replaceAll(/'/, '"');
        photo_full_info     = $.parseJSON(photo_full_info_str);
    } else {
        photo_full_info = [];
    }

    switchBetweenFullAndPreview();

    $("#photo_content").replaceWith(photo_html);
    // восстанавливаем форму Предложить перевод
    //page_toolbar_clone.insertAfter( "#content h1:eq(0)" );      

    // указывается новый URL в форме Предложить перевод
    $("#offer_tr_uri").val(global_photo_href);
    // вытаскивается ID из URL
    $("#offer_tr_id").val(photo_id);
    
    // if link points to the comment, show comments
    var hash_url = $.address.value();
    if (hash_url && hash_url.substr(0, 9) == '/comment-') {            
        showPhotoComments();
    }    
    
    loading_photo = false;
}

// switch between Full and Preview photos depending on viewport size
function switchBetweenFullAndPreview()
{
    // replace IMG address with Preview if needed
    var img_el = $("#photo_content .full_photo_img");

    if (isReplaceWithPreviewNeeded()) {
        if (photo_preview_info['url'] && img_el.attr('src') != photo_preview_info['url']) {
            img_el.attr('src', photo_preview_info['url']);
        }        
    } else {
        if (photo_full_info['url'] && img_el.attr('src') != photo_full_info['url']) {
            img_el.attr('src', photo_full_info['url']);
        } 
    }
}

// Check if photo should be replaced with Preview
function isReplaceWithPreviewNeeded()
{
    if (page_mode != 'enlarge_photo' 
        || (page_mode == 'enlarge_photo' 
            && ((typeof new_photo_width != "undefined" && new_photo_width >= new_photo_height && new_photo_width <= min_photo_full_width)
            || (typeof new_photo_height != "undefined" && new_photo_height > new_photo_width && new_photo_height <= min_photo_full_width)))
    ) {
        return true;
    } else {
        return false;
    }
}

// get any element if from URL
function getElementIdFromUrl(url)
{
    var match = url.match(/^[^\d]+(\d+).*$/);
    return match[1];
}

// получение адреса из хэша и редирект на страницу
function loadPhotoContentFromHash(domain)
{    
    var hash_url = $.address.value();
    if (hash_url && hash_url.substr(0, 2) == '/!') {            
        //loadPhotoContent( hash_url.substr(2, hash_url.length), true, domain );
        // получение домена 
        if (!domain) {
            domain = document.domain;
        }
        window.location  = 'http://' + domain + '/' + hash_url.substr(2, hash_url.length);
    }
}

// установка URL
function setUrl(full, remove_hash)
{
    if (!full) {
        return false;
    }
    try {
        if (history && history.pushState) {
            history.pushState({isMine:true}, 'title',  full );
        } else {
            if (remove_hash) {
                // удаляем хэш полностью, чтобы восстановить прежний адрес страницы
                // если использовать
                // $.address.value(''); 
                // браузер прокрутит на самый верх страницы
                window.location.hash = '';
            } else {
                // получаем всё, что идёт после домена без начального /
                relative_url = full.replace(/http:\/\/[^\/]+\//, '');
                $.address.value('/!' + relative_url); 
            }
        }
        // меняем ссылку на мобильную версию и язык
        if (page_mode != 'enlarge_photo') {
            setUrlMobile(full);
            setUrlLangList(full);
        }
    } catch (e) {
    }
}

// установка ссылки на мобильную версию
function setUrlMobile(url)
{
    var mobile_url = url.replace("www.", "m.");
    $("#m_link a").each(function(n,element){
        $(element).attr("href", mobile_url);
    });
    $("#m_link img").each(function(n,element){
        var m_src = $(element).attr("src");
        $(element).attr("src", m_src.replace(/(.*&d=).*/, "$1") + mobile_url);
    });
}

// установка ссылок в переключателе языка
function setUrlLangList(href)
{
    cur_href_no_culture = href.replace(/http:\/\/[^\/]+\//, '').replace(/[^\/]+\//, '');

    $("#lang_column a, #lang_plain a").each(function(index) {
        culture_href = $(this).attr('href').replace(/(http:\/\/[^\/]+\/[^\/]+\/).*/, '$1' + cur_href_no_culture);
        $(this).attr('href', culture_href);
    });  
}

// отображение формы Предолжить перевод
function switchOfferTr(fields_url, error_msg) 
{    
    // если поля уже загружены
    if (!$("#offer_tr_fields").is(':empty')) {
        if ( $("#offer_tr").is(":hidden") ) {
            pageToolsTriggerShow("offer_tr");
            
            // если форма была отправлена
            if (!$("#offer_tr_success").is(":hidden")) {
                $("#offer_tr_fields textarea").val('');            
            }
            $("#offer_tr_success").hide();
        } else {
            pageToolsTriggerHide("offer_tr");
        }
    } else {
        // загрузка полей
        $("#offer_tr_loader").show();
        pageToolsTriggerShow("offer_tr");
        
        $.ajax({
            url: fields_url,
            dataType: "html",
            success: function(data) {
                $("#offer_tr_fields").html(data);
                $("#offer_tr_loader").hide();
                $("#offer_tr").show();
                cbResize($(window).scrollTop());
            },
            error: function(data) {
                $("#offer_tr_loader").hide();
            }
        });
    }
}

// отправка Перевода
function offerTrSubmit()
{    
    $("#offer_tr_success").show();
    $("#offer_tr").hide();
    return true;
}

// отображения формы отправки перевода
function showOfferTrMethod(radio)
{    
    $(".offer_tr_method").hide();
    $("#" + $(radio).val() ).show();
    cbResize($(window).scrollTop());
}

// отображение Истории изменений
function switchRevhistory()
{
    if ( $("#revhistory").is(":hidden") ) {
        pageToolsTriggerShow("revhistory");
    } else {
        pageToolsTriggerHide("revhistory");
    }
}

// отображение Истории изменений
function switchEmbed()
{
    if ( $("#embed").is(":hidden") ) {
        pageToolsTriggerShow("embed");
    } else {
        pageToolsTriggerHide("embed");
    }
}

// показать кнопку
function pageToolsTriggerShow(mnemonic_id)
{
    // скрываются все остальные кнопки
    $(".page_tools").each(function(index) {
        pageToolsTriggerHide( $(this).attr('id') );
    });    
        
    $("#"+mnemonic_id).show();
    $("#"+mnemonic_id+"_trigger").addClass('pt_btn_disabled');
    cbResize($(window).scrollTop());
}

// скрыть кнопку
function pageToolsTriggerHide(mnemonic_id)
{
    if ( !$("#"+mnemonic_id).is(":hidden") ) {
        $("#"+mnemonic_id).hide();
        $("#"+mnemonic_id+"_trigger").removeClass('pt_btn_disabled');
    }
    cbResize($(window).scrollTop());
}

// show comments for photo
function showPhotoComments(trigger_el)
{    
    var comments_html = Base64.decode( $("#photo_comments_code").html() );
    $("#photo_comments").html(comments_html).show();
    if (page_mode == 'enlarge_photo') {
        cb_comments_height = 398;
        resizePhotoColorbox();
    }
}

// get URL parameter
function getUrlParameters()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

//  show/hide latest news
function toggleLatestNews(id)
{
    $("#content .news_list td:not([class~='minimized'])").addClass('minimized');
    $("#content .news_list #lnews_"+id+'').removeClass('minimized');   
}

//  Open url correspionding to selected category
function gotoItemcategory(url)
{
    //$(".category_wrapper").append( '<img src="/i/loader_rect.gif" />' );
    window.location.href = url;
}

// Randomize array element order in-place.
// Using Fisher-Yates shuffle algorithm.
function shuffleArray(array)
{
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function pickRandomArrayElement(array)
{
    return array[Math.floor(Math.random()*array.length)];
}



// Run Carousel
function runCarousel()
{
    if ($.browser.ie && jQuery.browser.version < 7) {
        return;
    }
    
    var data_align_h = ['left', 'right'];
    var data_align_v = ['top', 'bottom'];
    
    var photo_direction = ''
    var carousel_html = '<ul>';
    
    // randomize quotes
    quote_list = shuffleArray(quote_list);

    // fetch random photos
    carousel_photo_list = shuffleArray(carousel_photo_list);

    for (i=0; i<carousel_photo_count; i++) {
        photo = carousel_photo_list[i];
        
        photo_direction = photo[1];
        if (photo_direction == 'h') {
            // horizontal photo
            if (Math.random() > 0.5) {
                data_startalign = "left";
                data_endalign   = "right";
            } else {
                data_startalign = "right";
                data_endalign   = "left";
            }
            var v_align = pickRandomArrayElement(data_align_v);
            data_startalign = data_startalign+","+v_align;
            if (v_align == 'top') {
                v_align = 'bottom';
            } else {
                v_align = 'top';
            }
            data_endalign   = data_endalign+","+v_align;
        } else {
            // vertical photo
            if (Math.random() > 0.5) {
                data_startalign = "top";
                data_endalign   = "bottom";
            } else {
                data_startalign = "bottom";
                data_endalign   = "top";
            }
            var h_align = pickRandomArrayElement(data_align_h);
            data_startalign = h_align+","+data_startalign;
            if (h_align == 'left') {
                h_align = 'right';
            } else {
                h_align = 'left';
            }
            data_endalign   = h_align+","+data_endalign;
        }
        
        carousel_html = carousel_html +
            '<li data-transition="fade" data-startalign="'+data_startalign+'" data-endAlign="'+data_endalign+'" data-zoom="in" data-zoomfact="1" data-panduration="15" data-colortransition="0" ><img alt="" src="'+photo[0]+'" >';

        if (typeof(quote_list[i]) != "undefined") {
            quote_text = quote_list[i][0];
            <?php if (!UserPeer::isCultureHieroglyphic()): ?>
                quote_text = quote_text + '...';
            <?php endif ?>

            carousel_html = carousel_html + '<div class="creative_layer"><div class="cp-bottom faderight">';

            if (typeof(quote_list[i][1]) != "undefined") {
                // there is a link to teaching
                //if ($.browser.ie && $.browser.version < 8) {
                quote_url = quote_list[i][1];
            } else {
                quote_url = '#';
            }
            carousel_html = carousel_html + '<a href="'+quote_url+'" title="<?php echo __("Read more") ?>"><p>'+quote_text+'<br/><span class="right">― <?php echo __("Maha Sambodhi Dharma Sangha") ?></span></p></a>';
            carousel_html = carousel_html + '</div></div>';
        }

        carousel_html = carousel_html + '</li>';
    }
    carousel_html = carousel_html + '</ul>';

    $("#carousel_main").css('height','300px').html(carousel_html);

    jQuery('#carousel_main').kenburn({
        /*width:800,*/
        /*height:300,*/
        //responsive:'off', // option does not work in plugin
        adjustToWindowSize:'off',
        trackWindowResize:'off',
        buttonsArrows:"off",
        blurwrap:"off",
        //rescaleBGColor:"#fff", // does not work
        thumbWidth:50,
        thumbHeight:50,
        thumbAmount:4,
        /*thumbSpaces:0,
        thumbPadding:9,*/
        hideThumbs:"off",
        thumbStyle:"bullet",
        thumbVideoIcon:"off",
        thumbVertical:"bottom",
        thumbHorizontal:"center",
        thumbXOffset:0,
        thumbYOffset:40,

        bulletXOffset:0,
        bulletYOffset:0,

        repairChromeBug:"on",
        touchenabled:'on',
        pauseOnRollOverThumbs:'off',
        pauseOnRollOverMain:'on',
        preloadedSlides:2,
        timer:15,
        debug:"off",

        captionParallaxX:0,
        captionParallaxY:0,

        googleFonts: '',
        googleFontJS: ''

        //shadow:'true' // do not work
    }); 
}


// replace all occurences of a string
String.prototype.replaceAll = function(search, replace){
  return this.split(search).join(replace);
}

// jmp3
jQuery.fn.jmp3=function(passedOptions){var playerpath="/swf/";var options={"filepath":"","backcolor":"","forecolor":"ffffff","width":"25","repeat":"no","volume":"50","autoplay":"false","showdownload":"true","showfilename":"true"};if(passedOptions){jQuery.extend(options,passedOptions)}return this.each(function(){var filename=options.filepath+jQuery(this).children().html();var mp3html='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';mp3html+='width="'+options.width+'" height="20" ';mp3html+='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">';mp3html+='<param name="movie" value="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" />';mp3html+='<param name="wmode" value="transparent" />';mp3html+='<embed wmode="transparent" width="'+options.width+'" height="20" ';mp3html+='src="'+playerpath+'singlemp3player.swf?';mp3html+='showDownload='+options.showdownload+'&file='+filename+'&autoStart='+options.autoplay;mp3html+='&backColor='+options.backcolor+'&frontColor='+options.forecolor;mp3html+='&repeatPlay='+options.repeat+'&songVolume='+options.volume+'" ';mp3html+='type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />';mp3html+='</object>';if(options.showfilename=="false"){jQuery(this).html("")}jQuery(this).prepend(mp3html+"&nbsp;");if(jQuery.browser.msie){this.outerHTML=this.outerHTML}})};


// jQuery Address Plugin v1.4
(function(c){c.address=function(){var v=function(a){c(c.address).trigger(c.extend(c.Event(a),function(){for(var b={},e=c.address.parameterNames(),f=0,p=e.length;f<p;f++)b[e[f]]=c.address.parameter(e[f]);return{value:c.address.value(),path:c.address.path(),pathNames:c.address.pathNames(),parameterNames:e,parameters:b,queryString:c.address.queryString()}}.call(c.address)))},w=function(){c().bind.apply(c(c.address),Array.prototype.slice.call(arguments));return c.address},r=function(){return M.pushState&&
d.state!==k},s=function(){return("/"+g.pathname.replace(new RegExp(d.state),"")+g.search+(D()?"#"+D():"")).replace(U,"/")},D=function(){var a=g.href.indexOf("#");return a!=-1?B(g.href.substr(a+1),l):""},u=function(){return r()?s():D()},ha=function(){return"javascript"},N=function(a){a=a.toString();return(d.strict&&a.substr(0,1)!="/"?"/":"")+a},B=function(a,b){if(d.crawlable&&b)return(a!==""?"!":"")+a;return a.replace(/^\!/,"")},x=function(a,b){return parseInt(a.css(b),10)},V=function(a){for(var b,
e,f=0,p=a.childNodes.length;f<p;f++){try{if("src"in a.childNodes[f]&&a.childNodes[f].src)b=String(a.childNodes[f].src)}catch(J){}if(e=V(a.childNodes[f]))b=e}return b},F=function(){if(!K){var a=u();if(h!=a)if(y&&q<7)g.reload();else{y&&q<8&&d.history&&t(O,50);h=a;E(l)}}},E=function(a){v(W);v(a?X:Y);t(Z,10)},Z=function(){if(d.tracker!=="null"&&d.tracker!==null){var a=c.isFunction(d.tracker)?d.tracker:j[d.tracker],b=(g.pathname+g.search+(c.address&&!r()?c.address.value():"")).replace(/\/\//,"/").replace(/^\/$/,
"");if(c.isFunction(a))a(b);else if(c.isFunction(j.urchinTracker))j.urchinTracker(b);else if(j.pageTracker!==k&&c.isFunction(j.pageTracker._trackPageview))j.pageTracker._trackPageview(b);else j._gaq!==k&&c.isFunction(j._gaq.push)&&j._gaq.push(["_trackPageview",decodeURI(b)])}},O=function(){var a=ha()+":"+l+";document.open();document.writeln('<html><head><title>"+n.title.replace("'","\\'")+"</title><script>var "+C+' = "'+encodeURIComponent(u())+(n.domain!=g.hostname?'";document.domain="'+n.domain:
"")+"\";<\/script></head></html>');document.close();";if(q<7)m.src=a;else m.contentWindow.location.replace(a)},aa=function(){if(G&&$!=-1){var a,b=G.substr($+1).split("&");for(i=0;i<b.length;i++){a=b[i].split("=");if(/^(autoUpdate|crawlable|history|strict|wrap)$/.test(a[0]))d[a[0]]=isNaN(a[1])?/^(true|yes)$/i.test(a[1]):parseInt(a[1],10)!==0;if(/^(state|tracker)$/.test(a[0]))d[a[0]]=a[1]}G=null}h=u()},ca=function(){if(!ba){ba=o;aa();var a=function(){ia.call(this);ja.call(this)},b=c("body").ajaxComplete(a);
a();if(d.wrap){c("body > *").wrapAll('<div style="padding:'+(x(b,"marginTop")+x(b,"paddingTop"))+"px "+(x(b,"marginRight")+x(b,"paddingRight"))+"px "+(x(b,"marginBottom")+x(b,"paddingBottom"))+"px "+(x(b,"marginLeft")+x(b,"paddingLeft"))+'px;" />').parent().wrap('<div id="'+C+'" style="height:100%;overflow:auto;position:relative;'+(H&&!window.statusbar.visible?"resize:both;":"")+'" />');c("html, body").css({height:"100%",margin:0,padding:0,overflow:"hidden"});H&&c('<style type="text/css" />').appendTo("head").text("#"+
C+"::-webkit-resizer { background-color: #fff; }")}if(y&&q<8){a=n.getElementsByTagName("frameset")[0];m=n.createElement((a?"":"i")+"frame");if(a){a.insertAdjacentElement("beforeEnd",m);a[a.cols?"cols":"rows"]+=",0";m.noResize=o;m.frameBorder=m.frameSpacing=0}else{m.style.display="none";m.style.width=m.style.height=0;m.tabIndex=-1;n.body.insertAdjacentElement("afterBegin",m)}t(function(){c(m).bind("load",function(){var e=m.contentWindow;h=e[C]!==k?e[C]:"";if(h!=u()){E(l);g.hash=B(h,o)}});m.contentWindow[C]===
k&&O()},50)}t(function(){v("init");E(l)},1);if(!r())if(y&&q>7||!y&&"on"+I in j)if(j.addEventListener)j.addEventListener(I,F,l);else j.attachEvent&&j.attachEvent("on"+I,F);else ka(F,50)}},ia=function(){var a,b=c("a"),e=b.size(),f=-1,p=function(){if(++f!=e){a=c(b.get(f));a.is('[rel*="address:"]')&&a.address();t(p,1)}};t(p,1)},la=function(){if(h!=u()){h=u();E(l)}},ma=function(){if(j.removeEventListener)j.removeEventListener(I,F,l);else j.detachEvent&&j.detachEvent("on"+I,F)},ja=function(){if(d.crawlable){var a=
g.pathname.replace(/\/$/,"");c("body").html().indexOf("_escaped_fragment_")!=-1&&c('a[href]:not([href^=http]), a[href*="'+document.domain+'"]').each(function(){var b=c(this).attr("href").replace(/^http:/,"").replace(new RegExp(a+"/?$"),"");if(b===""||b.indexOf("_escaped_fragment_")!=-1)c(this).attr("href","#"+b.replace(/\/(.*)\?_escaped_fragment_=(.*)$/,"!$2"))})}},k,C="jQueryAddress",I="hashchange",W="change",X="internalChange",Y="externalChange",o=true,l=false,d={autoUpdate:o,crawlable:l,history:o,
strict:o,wrap:l},z=c.browser,q=parseFloat(c.browser.version),da=z.mozilla,y=z.msie,ea=z.opera,H=z.webkit||z.safari,P=l,j=function(){try{return top.document!==k?top:window}catch(a){return window}}(),n=j.document,M=j.history,g=j.location,ka=setInterval,t=setTimeout,U=/\/{2,9}/g;z=navigator.userAgent;var m,G=V(document),$=G?G.indexOf("?"):-1,Q=n.title,K=l,ba=l,R=o,fa=o,L=l,h=u();if(y){q=parseFloat(z.substr(z.indexOf("MSIE")+4));if(n.documentMode&&n.documentMode!=q)q=n.documentMode!=8?7:8;var ga=n.onpropertychange;
n.onpropertychange=function(){ga&&ga.call(n);if(n.title!=Q&&n.title.indexOf("#"+u())!=-1)n.title=Q}}if(P=da&&q>=1||y&&q>=6||ea&&q>=9.5||H&&q>=523){if(ea)history.navigationMode="compatible";if(document.readyState=="complete")var na=setInterval(function(){if(c.address){ca();clearInterval(na)}},50);else{aa();c(ca)}c(window).bind("popstate",la).bind("unload",ma)}else!P&&D()!==""?g.replace(g.href.substr(0,g.href.indexOf("#"))):Z();return{bind:function(a,b,e){return w(a,b,e)},init:function(a){return w("init",
a)},change:function(a){return w(W,a)},internalChange:function(a){return w(X,a)},externalChange:function(a){return w(Y,a)},baseURL:function(){var a=g.href;if(a.indexOf("#")!=-1)a=a.substr(0,a.indexOf("#"));if(/\/$/.test(a))a=a.substr(0,a.length-1);return a},autoUpdate:function(a){if(a!==k){d.autoUpdate=a;return this}return d.autoUpdate},crawlable:function(a){if(a!==k){d.crawlable=a;return this}return d.crawlable},history:function(a){if(a!==k){d.history=a;return this}return d.history},state:function(a){if(a!==
k){d.state=a;var b=s();if(d.state!==k)if(M.pushState)b.substr(0,3)=="/#/"&&g.replace(d.state.replace(/^\/$/,"")+b.substr(2));else b!="/"&&b.replace(/^\/#/,"")!=D()&&t(function(){g.replace(d.state.replace(/^\/$/,"")+"/#"+b)},1);return this}return d.state},strict:function(a){if(a!==k){d.strict=a;return this}return d.strict},tracker:function(a){if(a!==k){d.tracker=a;return this}return d.tracker},wrap:function(a){if(a!==k){d.wrap=a;return this}return d.wrap},update:function(){L=o;this.value(h);L=l;return this},
title:function(a){if(a!==k){t(function(){Q=n.title=a;if(fa&&m&&m.contentWindow&&m.contentWindow.document){m.contentWindow.document.title=a;fa=l}if(!R&&da)g.replace(g.href.indexOf("#")!=-1?g.href:g.href+"#");R=l},50);return this}return n.title},value:function(a){if(a!==k){a=N(a);if(a=="/")a="";if(h==a&&!L)return;R=o;h=a;if(d.autoUpdate||L){E(o);if(r())M[d.history?"pushState":"replaceState"]({},"",d.state.replace(/\/$/,"")+(h===""?"/":h));else{K=o;if(H)if(d.history)g.hash="#"+B(h,o);else g.replace("#"+
B(h,o));else if(h!=u())if(d.history)g.hash="#"+B(h,o);else g.replace("#"+B(h,o));y&&q<8&&d.history&&t(O,50);if(H)t(function(){K=l},1);else K=l}}return this}if(!P)return null;return N(h)},path:function(a){if(a!==k){var b=this.queryString(),e=this.hash();this.value(a+(b?"?"+b:"")+(e?"#"+e:""));return this}return N(h).split("#")[0].split("?")[0]},pathNames:function(){var a=this.path(),b=a.replace(U,"/").split("/");if(a.substr(0,1)=="/"||a.length===0)b.splice(0,1);a.substr(a.length-1,1)=="/"&&b.splice(b.length-
1,1);return b},queryString:function(a){if(a!==k){var b=this.hash();this.value(this.path()+(a?"?"+a:"")+(b?"#"+b:""));return this}a=h.split("?");return a.slice(1,a.length).join("?").split("#")[0]},parameter:function(a,b,e){var f,p;if(b!==k){var J=this.parameterNames();p=[];b=b?b.toString():"";for(f=0;f<J.length;f++){var S=J[f],A=this.parameter(S);if(typeof A=="string")A=[A];if(S==a)A=b===null||b===""?[]:e?A.concat([b]):[b];for(var T=0;T<A.length;T++)p.push(S+"="+A[T])}c.inArray(a,J)==-1&&b!==null&&
b!==""&&p.push(a+"="+b);this.queryString(p.join("&"));return this}if(b=this.queryString()){e=[];p=b.split("&");for(f=0;f<p.length;f++){b=p[f].split("=");b[0]==a&&e.push(b.slice(1).join("="))}if(e.length!==0)return e.length!=1?e:e[0]}},parameterNames:function(){var a=this.queryString(),b=[];if(a&&a.indexOf("=")!=-1){a=a.split("&");for(var e=0;e<a.length;e++){var f=a[e].split("=")[0];c.inArray(f,b)==-1&&b.push(f)}}return b},hash:function(a){if(a!==k){this.value(h.split("#")[0]+(a?"#"+a:""));return this}a=
h.split("#");return a.slice(1,a.length).join("#")}}}();c.fn.address=function(v){if(!c(this).attr("address")){var w=function(r){if(r.shiftKey||r.ctrlKey||r.metaKey)return true;if(c(this).is("a")){var s=v?v.call(this):/address:/.test(c(this).attr("rel"))?c(this).attr("rel").split("address:")[1].split(" ")[0]:c.address.state()!==undefined&&c.address.state()!="/"?c(this).attr("href").replace(new RegExp("^(.*"+c.address.state()+"|\\.)"),""):c(this).attr("href").replace(/^(#\!?|\.)/,"");c.address.value(s);
r.preventDefault()}};c(this).click(w).live("click",w).live("submit",function(r){if(c(this).is("form")){var s=c(this).attr("action");s=v?v.call(this):(s.indexOf("?")!=-1?s.replace(/&$/,""):s+"?")+c(this).serialize();c.address.value(s);r.preventDefault()}}).attr("address",true)}return this}})(jQuery);

// ColorBox v1.3.18 - a full featured, light-weight, customizable lightbox based on jQuery 1.3+
// Copyright (c) 2011 Jack Moore - jack@colorpowered.com
// Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php

(function(H,k,U){var I={transition:"elastic",speed:300,width:false,initialWidth:"600",innerWidth:false,maxWidth:false,height:false,initialHeight:"450",innerHeight:false,maxHeight:false,scalePhotos:true,scrolling:true,inline:false,html:false,iframe:false,fastIframe:true,photo:false,href:false,title:false,rel:false,opacity:0.9,preloading:true,current:"image {current} of {total}",previous:"previous",next:"next",close:"close",open:false,returnFocus:true,loop:true,slideshow:false,slideshowAuto:true,slideshowSpeed:2500,slideshowStart:"start slideshow",slideshowStop:"stop slideshow",onOpen:false,onLoad:false,onComplete:false,onCleanup:false,onClosed:false,overlayClose:true,escKey:true,arrowKey:true,top:false,bottom:false,left:false,right:false,fixed:false,data:undefined},v="colorbox",Q="cbox",p=Q+"Element",T=Q+"_open",e=Q+"_load",S=Q+"_complete",s=Q+"_cleanup",Z=Q+"_closed",i=Q+"_purge",t=H.browser.msie&&!H.support.opacity,ac=t&&H.browser.version<7,Y=Q+"_IE6",O,ad,ae,d,F,o,b,N,c,X,L,j,h,n,r,V,q,P,x,z,ab,af,l,g,a,u,G,m,B,W,K,y,J,aa="div";function E(ag,aj,ai){var ah=k.createElement(ag);if(aj){ah.id=Q+aj}if(ai){ah.style.cssText=ai}return H(ah)}function C(ah){var ag=c.length,ai=(G+ah)%ag;return(ai<0)?ag+ai:ai}function M(ag,ah){return Math.round((/%/.test(ag)?((ah==="x"?X.width():X.height())/100):1)*parseInt(ag,10))}function A(ag){return ab.photo||/\.(gif|png|jpe?g|bmp|ico)((#|\?).*)?$/i.test(ag)}function R(){var ag;ab=H.extend({},H.data(u,v));for(ag in ab){if(H.isFunction(ab[ag])&&ag.slice(0,2)!=="on"){ab[ag]=ab[ag].call(u)}}ab.rel=ab.rel||u.rel||"nofollow";ab.href=ab.href||H(u).attr("href");ab.title=ab.title||u.title;if(typeof ab.href==="string"){ab.href=H.trim(ab.href)}}function D(ag,ah){H.event.trigger(ag);if(ah){ah.call(u)}}function w(){var ah,aj=Q+"Slideshow_",ak="click."+Q,al,ai,ag;if(ab.slideshow&&c[1]){al=function(){V.text(ab.slideshowStop).unbind(ak).bind(S,function(){if(G<c.length-1||ab.loop){ah=setTimeout(J.next,ab.slideshowSpeed)}}).bind(e,function(){clearTimeout(ah)}).one(ak+" "+s,ai);ad.removeClass(aj+"off").addClass(aj+"on");ah=setTimeout(J.next,ab.slideshowSpeed)};ai=function(){clearTimeout(ah);V.text(ab.slideshowStart).unbind([S,e,s,ak].join(" ")).one(ak,function(){J.next();al()});ad.removeClass(aj+"on").addClass(aj+"off")};if(ab.slideshowAuto){al()}else{ai()}}else{ad.removeClass(aj+"off "+aj+"on")}}function f(ah){if(!K){u=ah;R();c=H(u);G=0;if(ab.rel!=="nofollow"){c=H("."+p).filter(function(){var ai=H.data(this,v).rel||this.rel;return(ai===ab.rel)});G=c.index(u);if(G===-1){c=c.add(u);G=c.length-1}}if(!B){B=W=true;ad.show();if(ab.returnFocus){try{u.blur();H(u).one(Z,function(){try{this.focus()}catch(ai){}})}catch(ag){}}O.css({opacity:+ab.opacity,cursor:ab.overlayClose?"pointer":"auto"}).show();ab.w=M(ab.initialWidth,"x");ab.h=M(ab.initialHeight,"y");J.position();if(ac){X.bind("resize."+Y+" scroll."+Y,function(){O.css({width:X.width(),height:X.height(),top:X.scrollTop(),left:X.scrollLeft()})}).trigger("resize."+Y)}D(T,ab.onOpen);z.add(n).hide();x.html(ab.close).show()}J.load(true)}}J=H.fn[v]=H[v]=function(ag,ai){var ah=this;ag=ag||{};J.init();if(!ah[0]){if(ah.selector){return ah}ah=H("<a/>");ag.open=true}if(ai){ag.onComplete=ai}ah.each(function(){H.data(this,v,H.extend({},H.data(this,v)||I,ag));H(this).addClass(p)});if((H.isFunction(ag.open)&&ag.open.call(ah))||ag.open){f(ah[0])}return ah};J.init=function(){if(!ad){if(!H("body")[0]){H(J.init);return}X=H(U);ad=E(aa).attr({id:v,"class":t?Q+(ac?"IE6":"IE"):""});O=E(aa,"Overlay",ac?"position:absolute":"").hide();ae=E(aa,"Wrapper");d=E(aa,"Content").append(L=E(aa,"LoadedContent","width:0; height:0; overflow:hidden"),h=E(aa,"LoadingOverlay").add(E(aa,"LoadingGraphic")),n=E(aa,"Title"),r=E(aa,"Current"),q=E(aa,"Next"),P=E(aa,"Previous"),V=E(aa,"Slideshow").bind(T,w),x=E(aa,"Close"));ae.append(E(aa).append(E(aa,"TopLeft"),F=E(aa,"TopCenter"),E(aa,"TopRight")),E(aa,false,"clear:left").append(o=E(aa,"MiddleLeft"),d,b=E(aa,"MiddleRight")),E(aa,false,"clear:left").append(E(aa,"BottomLeft"),N=E(aa,"BottomCenter"),E(aa,"BottomRight"))).find("div div").css({"float":"left"});j=E(aa,false,"position:absolute; width:9999px; visibility:hidden; display:none");H("body").prepend(O,ad.append(ae,j));af=F.height()+N.height()+d.outerHeight(true)-d.height();l=o.width()+b.width()+d.outerWidth(true)-d.width();g=L.outerHeight(true);a=L.outerWidth(true);ad.css({"padding-bottom":af,"padding-right":l}).hide();q.click(function(){J.next()});P.click(function(){J.prev()});x.click(function(){J.close()});z=q.add(P).add(r).add(V);O.click(function(){if(ab.overlayClose){J.close()}});H(k).bind("keydown."+Q,function(ah){var ag=ah.keyCode;if(B&&ab.escKey&&ag===27){ah.preventDefault();J.close()}if(B&&ab.arrowKey&&c[1]){if(ag===37){ah.preventDefault();P.click()}else{if(ag===39){ah.preventDefault();q.click()}}}})}};J.remove=function(){ad.add(O).remove();ad=null;H("."+p).removeData(v).removeClass(p)};J.position=function(ah,ag){var aj=0,ai=0,ak=ad.offset();X.unbind("resize."+Q);ad.css({top:-99999,left:-99999});if(ab.fixed&&!ac){ad.css({position:"fixed"})}else{aj=X.scrollTop();ai=X.scrollLeft();ad.css({position:"absolute"})}if(ab.right!==false){ai+=Math.max(X.width()-ab.w-a-l-M(ab.right,"x"),0)}else{if(ab.left!==false){ai+=M(ab.left,"x")}else{ai+=Math.round(Math.max(X.width()-ab.w-a-l,0)/2)}}if(ab.bottom!==false){aj+=Math.max(X.height()-ab.h-g-af-M(ab.bottom,"y"),0)}else{if(ab.top!==false){aj+=M(ab.top,"y")}else{aj+=Math.round(Math.max(X.height()-ab.h-g-af,0)/2)}}ad.css({top:ak.top,left:ak.left});ah=(ad.width()===ab.w+a&&ad.height()===ab.h+g)?0:ah||0;ae[0].style.width=ae[0].style.height="9999px";function al(am){F[0].style.width=N[0].style.width=d[0].style.width=am.style.width;h[0].style.height=h[1].style.height=d[0].style.height=o[0].style.height=b[0].style.height=am.style.height}ad.dequeue().animate({width:ab.w+a,height:ab.h+g,top:aj,left:ai},{duration:ah,complete:function(){al(this);W=false;ae[0].style.width=(ab.w+a+l)+"px";ae[0].style.height=(ab.h+g+af)+"px";if(ag){ag()}setTimeout(function(){X.bind("resize."+Q,J.position)},1)},step:function(){al(this)}})};J.resize=function(ag){if(B){ag=ag||{};if(ag.width){ab.w=M(ag.width,"x")-a-l}if(ag.innerWidth){ab.w=M(ag.innerWidth,"x")}L.css({width:ab.w});if(ag.height){ab.h=M(ag.height,"y")-g-af}if(ag.innerHeight){ab.h=M(ag.innerHeight,"y")}if(!ag.innerHeight&&!ag.height){L.css({height:"auto"});ab.h=L.height()}L.css({height:ab.h});J.position(ab.transition==="none"?0:ab.speed)}};J.prep=function(ah){if(!B){return}var ak,ai=ab.transition==="none"?0:ab.speed;L.remove();L=E(aa,"LoadedContent").append(ah);function ag(){ab.w=ab.w||L.width();ab.w=ab.mw&&ab.mw<ab.w?ab.mw:ab.w;return ab.w}function aj(){ab.h=ab.h||L.height();ab.h=ab.mh&&ab.mh<ab.h?ab.mh:ab.h;return ab.h}L.hide().appendTo(j.show()).css({width:ag(),overflow:ab.scrolling?ab.scrolling:"auto"}).css({height:aj()}).prependTo(d);j.hide();H(m).css({"float":"none"});if(ac){H("select").not(ad.find("select")).filter(function(){return this.style.visibility!=="hidden"}).css({visibility:"hidden"}).one(s,function(){this.style.visibility="inherit"})}ak=function(){var av,ar,at=c.length,ap,au="frameBorder",ao="allowTransparency",am,al,aq;if(!B){return}function an(){if(t){ad[0].style.removeAttribute("filter")}}am=function(){clearTimeout(y);h.hide();D(S,ab.onComplete)};if(t){if(m){L.fadeIn(100)}}n.html(ab.title).add(L).show();if(at>1){if(typeof ab.current==="string"){r.html(ab.current.replace("{current}",G+1).replace("{total}",at)).show()}q[(ab.loop||G<at-1)?"show":"hide"]().html(ab.next);P[(ab.loop||G)?"show":"hide"]().html(ab.previous);if(ab.slideshow){V.show()}if(ab.preloading){av=[C(-1),C(1)];while((ar=c[av.pop()])){al=H.data(ar,v).href||ar.href;if(H.isFunction(al)){al=al.call(ar)}if(A(al)){aq=new Image();aq.src=al}}}}else{z.hide()}if(ab.iframe){ap=E("iframe")[0];if(au in ap){ap[au]=0}if(ao in ap){ap[ao]="true"}ap.name=Q+(+new Date());if(ab.fastIframe){am()}else{H(ap).one("load",am)}ap.src=ab.href;if(!ab.scrolling){ap.scrolling="no"}H(ap).addClass(Q+"Iframe").appendTo(L).one(i,function(){ap.src="//about:blank"})}else{am()}if(ab.transition==="fade"){ad.fadeTo(ai,1,an)}else{an()}};if(ab.transition==="fade"){ad.fadeTo(ai,0,function(){J.position(0,ak)})}else{J.position(ai,ak)}};J.load=function(ai){var ah,aj,ag=J.prep;W=true;m=false;u=c[G];if(!ai){R()}D(i);D(e,ab.onLoad);ab.h=ab.height?M(ab.height,"y")-g-af:ab.innerHeight&&M(ab.innerHeight,"y");ab.w=ab.width?M(ab.width,"x")-a-l:ab.innerWidth&&M(ab.innerWidth,"x");ab.mw=ab.w;ab.mh=ab.h;if(ab.maxWidth){ab.mw=M(ab.maxWidth,"x")-a-l;ab.mw=ab.w&&ab.w<ab.mw?ab.w:ab.mw}if(ab.maxHeight){ab.mh=M(ab.maxHeight,"y")-g-af;ab.mh=ab.h&&ab.h<ab.mh?ab.h:ab.mh}ah=ab.href;y=setTimeout(function(){h.show()},100);if(ab.inline){E(aa).hide().insertBefore(H(ah)[0]).one(i,function(){H(this).replaceWith(L.children())});ag(H(ah))}else{if(ab.iframe){ag(" ")}else{if(ab.html){ag(ab.html)}else{if(A(ah)){H(m=new Image()).addClass(Q+"Photo").error(function(){ab.title=false;ag(E(aa,"Error").text("This image could not be loaded"))}).load(function(){var ak;m.onload=null;if(ab.scalePhotos){aj=function(){m.height-=m.height*ak;m.width-=m.width*ak};if(ab.mw&&m.width>ab.mw){ak=(m.width-ab.mw)/m.width;aj()}if(ab.mh&&m.height>ab.mh){ak=(m.height-ab.mh)/m.height;aj()}}if(ab.h){m.style.marginTop=Math.max(ab.h-m.height,0)/2+"px"}if(c[1]&&(G<c.length-1||ab.loop)){m.style.cursor="pointer";m.onclick=function(){J.next()}}if(t){m.style.msInterpolationMode="bicubic"}setTimeout(function(){ag(m)},1)});setTimeout(function(){m.src=ah},1)}else{if(ah){j.load(ah,ab.data,function(al,ak,am){ag(ak==="error"?E(aa,"Error").text("Request unsuccessful: "+am.statusText):H(this).contents())})}}}}}};J.next=function(){if(!W&&c[1]&&(G<c.length-1||ab.loop)){G=C(1);J.load()}};J.prev=function(){if(!W&&c[1]&&(G||ab.loop)){G=C(-1);J.load()}};J.close=function(){if(B&&!K){K=true;B=false;D(s,ab.onCleanup);X.unbind("."+Q+" ."+Y);O.fadeTo(200,0);ad.stop().fadeTo(300,0,function(){ad.add(O).css({opacity:1,cursor:"auto"}).hide();D(i);L.remove();setTimeout(function(){K=false;D(Z,ab.onClosed)},1)})}};J.element=function(){return H(u)};J.settings=I;H("."+p,k).live("click",function(ag){if(!(ag.which>1||ag.shiftKey||ag.altKey||ag.metaKey)){ag.preventDefault();f(this)}});J.init()}(jQuery,document,this));

// base 64
// http://md5x.ru/a/Realizaciy_Base64_na_Javascript.html
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(c){var a="";var k,h,f,j,g,e,d;var b=0;c=Base64._utf8_encode(c);while(b<c.length){k=c.charCodeAt(b++);h=c.charCodeAt(b++);f=c.charCodeAt(b++);j=k>>2;g=((k&3)<<4)|(h>>4);e=((h&15)<<2)|(f>>6);d=f&63;if(isNaN(h)){e=d=64}else{if(isNaN(f)){d=64}}a=a+this._keyStr.charAt(j)+this._keyStr.charAt(g)+this._keyStr.charAt(e)+this._keyStr.charAt(d)}return a},decode:function(c){var a="";var k,h,f;var j,g,e,d;var b=0;c=c.replace(/[^A-Za-z0-9\+\/\=]/g,"");while(b<c.length){j=this._keyStr.indexOf(c.charAt(b++));g=this._keyStr.indexOf(c.charAt(b++));e=this._keyStr.indexOf(c.charAt(b++));d=this._keyStr.indexOf(c.charAt(b++));k=(j<<2)|(g>>4);h=((g&15)<<4)|(e>>2);f=((e&3)<<6)|d;a=a+String.fromCharCode(k);if(e!=64){a=a+String.fromCharCode(h)}if(d!=64){a=a+String.fromCharCode(f)}}a=Base64._utf8_decode(a);return a},_utf8_encode:function(b){b=b.replace(/\r\n/g,"\n");var a="";for(var e=0;e<b.length;e++){var d=b.charCodeAt(e);if(d<128){a+=String.fromCharCode(d)}else{if((d>127)&&(d<2048)){a+=String.fromCharCode((d>>6)|192);a+=String.fromCharCode((d&63)|128)}else{a+=String.fromCharCode((d>>12)|224);a+=String.fromCharCode(((d>>6)&63)|128);a+=String.fromCharCode((d&63)|128)}}}return a},_utf8_decode:function(a){var b="";var d=0;var e=c1=c2=0;while(d<a.length){e=a.charCodeAt(d);if(e<128){b+=String.fromCharCode(e);d++}else{if((e>191)&&(e<224)){c2=a.charCodeAt(d+1);b+=String.fromCharCode(((e&31)<<6)|(c2&63));d+=2}else{c2=a.charCodeAt(d+1);c3=a.charCodeAt(d+2);b+=String.fromCharCode(((e&15)<<12)|((c2&63)<<6)|(c3&63));d+=3}}}return b}};

// https://github.com/jaz303/tipsy
// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// releated under the MIT license
// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// releated under the MIT license

(function($) {
    
    function fixTitle($ele) {
        if ($ele.attr('title') || typeof($ele.attr('original-title')) != 'string') {
            $ele.attr('original-title', $ele.attr('title') || '').removeAttr('title');
        }
    }
    
    function Tipsy(element, options) {
        this.$element = $(element);
        this.options = options;
        this.enabled = true;
        fixTitle(this.$element);
    }
    
    Tipsy.prototype = {
        show: function() {
            var title = this.getTitle();
            if (title && this.enabled) {
                var $tip = this.tip();
                $tip.find('.tipsy-inner')[this.options.html ? 'html' : 'text'](title);
                $tip[0].className = 'tipsy'; // reset classname in case of dynamic gravity
                $tip.remove().css({top: 0, left: 0, visibility: 'hidden', display: 'block'}).appendTo(document.body);
                
                var pos = $.extend({}, this.$element.offset(), {
                    width: this.$element[0].offsetWidth,
                    height: this.$element[0].offsetHeight
                });
                
                var actualWidth = $tip[0].offsetWidth, actualHeight = $tip[0].offsetHeight;
                var gravity = (typeof this.options.gravity == 'function')
                                ? this.options.gravity.call(this.$element[0])
                                : this.options.gravity;
                
                var tp;
                switch (gravity.charAt(0)) {
                    case 'n':
                        tp = {top: pos.top + pos.height + this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
                        break;
                    case 's':
                        tp = {top: pos.top - actualHeight - this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
                        break;
                    case 'e':
                        tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth - this.options.offset};
                        break;
                    case 'w':
                        tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width + this.options.offset};
                        break;
                }
                
                if (gravity.length == 2) {
                    if (gravity.charAt(1) == 'w') {
                        tp.left = pos.left + pos.width / 2 - 15;
                    } else {
                        tp.left = pos.left + pos.width / 2 - actualWidth + 15;
                    }
                }
                
                $tip.css(tp).addClass('tipsy-' + gravity);                
                
                if (this.options.fade) {
                    $tip.stop().css({opacity: 0, display: 'block', visibility: 'visible'}).animate({opacity: this.options.opacity});
                } else {                
                    $tip.css({visibility: 'visible', opacity: this.options.opacity});
                }
                
            }
        },
        
        hide: function() {
            if (this.options.fade) {
                this.tip().stop().fadeOut(function() { $(this).remove(); });
            } else {
                this.tip().remove();
            }
        },
        
        getTitle: function() {
            var title, $e = this.$element, o = this.options;
            fixTitle($e);
            var title, o = this.options;
            if (typeof o.title == 'string') {
                title = $e.attr(o.title == 'title' ? 'original-title' : o.title);
            } else if (typeof o.title == 'function') {
                title = o.title.call($e[0]);
            }
            title = ('' + title).replace(/(^\s*|\s*$)/, "");
            return title || o.fallback;
        },
        
        tip: function() {
            if (!this.$tip) {
                this.$tip = $('<div class="tipsy"><div class="tipsy-arrow"></div><div class="tipsy-inner"></div></div>');
            }
            return this.$tip;
        },
        
        validate: function() {
            if (!this.$element[0].parentNode) {
                this.hide();
                this.$element = null;
                this.options = null;
            }
        },
        
        enable: function() { this.enabled = true; },
        disable: function() { this.enabled = false; },
        toggleEnabled: function() { this.enabled = !this.enabled; }
    };
    
    $.fn.tipsy = function(options) {
        
        if (options === true) {
            return this.data('tipsy');
        } else if (typeof options == 'string') {
            return this.data('tipsy')[options]();
        }
        
        options = $.extend({}, $.fn.tipsy.defaults, options);
        
        function get(ele) {
            var tipsy = $.data(ele, 'tipsy');
            if (!tipsy) {
                tipsy = new Tipsy(ele, $.fn.tipsy.elementOptions(ele, options));
                $.data(ele, 'tipsy', tipsy);
            }
            return tipsy;
        }
        
        function enter() {
            var tipsy = get(this);
            tipsy.hoverState = 'in';
            if (options.delayIn == 0) {
                tipsy.show();
            } else {
                setTimeout(function() { if (tipsy.hoverState == 'in') tipsy.show(); }, options.delayIn);
            }
        };
        
        function leave() {
            var tipsy = get(this);
            tipsy.hoverState = 'out';
            if (options.delayOut == 0) {
                tipsy.hide();
            } else {
                setTimeout(function() { if (tipsy.hoverState == 'out') tipsy.hide(); }, options.delayOut);
            }
        };
        
        if (!options.live) this.each(function() { get(this); });
        
        if (options.trigger != 'manual') {
            var binder   = options.live ? 'live' : 'bind',
                eventIn  = options.trigger == 'hover' ? 'mouseenter' : 'focus',
                eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur';
            this[binder](eventIn, enter)[binder](eventOut, leave);
        }
        
        return this;
        
    };
    
    $.fn.tipsy.defaults = {
        delayIn: 0,
        delayOut: 0,
        fade: false,
        fallback: '',
        gravity: 'n',
        html: false,
        live: false,
        offset: 0,
        opacity: 0.8,
        title: 'title',
        trigger: 'hover'
    };
    
    // Overwrite this method to provide options on a per-element basis.
    // For example, you could store the gravity in a 'tipsy-gravity' attribute:
    // return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
    // (remember - do not modify 'options' in place!)
    $.fn.tipsy.elementOptions = function(ele, options) {
        return $.metadata ? $.extend({}, options, $(ele).metadata()) : options;
    };
    
    $.fn.tipsy.autoNS = function() {
        return $(this).offset().top > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
    };
    
    $.fn.tipsy.autoWE = function() {
        return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
    };
    
})(jQuery);


/**
 * easyXDM
 * http://easyxdm.net/
 * Copyright(c) 2009-2011, Oyvind Sean Kinsey, oyvind@kinsey.no.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
(function(N,d,p,K,k,H){var b=this;var n=Math.floor(Math.random()*10000);var q=Function.prototype;var Q=/^((http.?:)\/\/([^:\/\s]+)(:\d+)*)/;var R=/[\-\w]+\/\.\.\//;var F=/([^:])\/\//g;var I="";var o={};var M=N.easyXDM;var U="easyXDM_";var E;var y=false;var i;var h;function C(X,Z){var Y=typeof X[Z];return Y=="function"||(!!(Y=="object"&&X[Z]))||Y=="unknown"}function u(X,Y){return !!(typeof(X[Y])=="object"&&X[Y])}function r(X){return Object.prototype.toString.call(X)==="[object Array]"}function c(){try{var X=new ActiveXObject("ShockwaveFlash.ShockwaveFlash");i=Array.prototype.slice.call(X.GetVariable("$version").match(/(\d+),(\d+),(\d+),(\d+)/),1);h=parseInt(i[0],10)>9&&parseInt(i[1],10)>0;X=null;return true}catch(Y){return false}}var v,x;if(C(N,"addEventListener")){v=function(Z,X,Y){Z.addEventListener(X,Y,false)};x=function(Z,X,Y){Z.removeEventListener(X,Y,false)}}else{if(C(N,"attachEvent")){v=function(X,Z,Y){X.attachEvent("on"+Z,Y)};x=function(X,Z,Y){X.detachEvent("on"+Z,Y)}}else{throw new Error("Browser not supported")}}var W=false,J=[],L;if("readyState" in d){L=d.readyState;W=L=="complete"||(~navigator.userAgent.indexOf("AppleWebKit/")&&(L=="loaded"||L=="interactive"))}else{W=!!d.body}function s(){if(W){return}W=true;for(var X=0;X<J.length;X++){J[X]()}J.length=0}if(!W){if(C(N,"addEventListener")){v(d,"DOMContentLoaded",s)}else{v(d,"readystatechange",function(){if(d.readyState=="complete"){s()}});if(d.documentElement.doScroll&&N===top){var g=function(){if(W){return}try{d.documentElement.doScroll("left")}catch(X){K(g,1);return}s()};g()}}v(N,"load",s)}function G(Y,X){if(W){Y.call(X);return}J.push(function(){Y.call(X)})}function m(){var Z=parent;if(I!==""){for(var X=0,Y=I.split(".");X<Y.length;X++){Z=Z[Y[X]]}}return Z.easyXDM}function e(X){N.easyXDM=M;I=X;if(I){U="easyXDM_"+I.replace(".","_")+"_"}return o}function z(X){return X.match(Q)[3]}function f(X){return X.match(Q)[4]||""}function j(Z){var X=Z.toLowerCase().match(Q);var aa=X[2],ab=X[3],Y=X[4]||"";if((aa=="http:"&&Y==":80")||(aa=="https:"&&Y==":443")){Y=""}return aa+"//"+ab+Y}function B(X){X=X.replace(F,"$1/");if(!X.match(/^(http||https):\/\//)){var Y=(X.substring(0,1)==="/")?"":p.pathname;if(Y.substring(Y.length-1)!=="/"){Y=Y.substring(0,Y.lastIndexOf("/")+1)}X=p.protocol+"//"+p.host+Y+X}while(R.test(X)){X=X.replace(R,"")}return X}function P(X,aa){var ac="",Z=X.indexOf("#");if(Z!==-1){ac=X.substring(Z);X=X.substring(0,Z)}var ab=[];for(var Y in aa){if(aa.hasOwnProperty(Y)){ab.push(Y+"="+H(aa[Y]))}}return X+(y?"#":(X.indexOf("?")==-1?"?":"&"))+ab.join("&")+ac}var S=(function(X){X=X.substring(1).split("&");var Z={},aa,Y=X.length;while(Y--){aa=X[Y].split("=");Z[aa[0]]=k(aa[1])}return Z}(/xdm_e=/.test(p.search)?p.search:p.hash));function t(X){return typeof X==="undefined"}var O=function(){var Y={};var Z={a:[1,2,3]},X='{"a":[1,2,3]}';if(typeof JSON!="undefined"&&typeof JSON.stringify==="function"&&JSON.stringify(Z).replace((/\s/g),"")===X){return JSON}if(Object.toJSON){if(Object.toJSON(Z).replace((/\s/g),"")===X){Y.stringify=Object.toJSON}}if(typeof String.prototype.evalJSON==="function"){Z=X.evalJSON();if(Z.a&&Z.a.length===3&&Z.a[2]===3){Y.parse=function(aa){return aa.evalJSON()}}}if(Y.stringify&&Y.parse){O=function(){return Y};return Y}return null};function T(X,Y,Z){var ab;for(var aa in Y){if(Y.hasOwnProperty(aa)){if(aa in X){ab=Y[aa];if(typeof ab==="object"){T(X[aa],ab,Z)}else{if(!Z){X[aa]=Y[aa]}}}else{X[aa]=Y[aa]}}}return X}function a(){var Y=d.body.appendChild(d.createElement("form")),X=Y.appendChild(d.createElement("input"));X.name=U+"TEST"+n;E=X!==Y.elements[X.name];d.body.removeChild(Y)}function A(X){if(t(E)){a()}var Z;if(E){Z=d.createElement('<iframe name="'+X.props.name+'"/>')}else{Z=d.createElement("IFRAME");Z.name=X.props.name}Z.id=Z.name=X.props.name;delete X.props.name;if(X.onLoad){v(Z,"load",X.onLoad)}if(typeof X.container=="string"){X.container=d.getElementById(X.container)}if(!X.container){T(Z.style,{position:"absolute",top:"-2000px"});X.container=d.body}var Y=X.props.src;delete X.props.src;T(Z,X.props);Z.border=Z.frameBorder=0;Z.allowTransparency=true;X.container.appendChild(Z);Z.src=Y;X.props.src=Y;return Z}function V(aa,Z){if(typeof aa=="string"){aa=[aa]}var Y,X=aa.length;while(X--){Y=aa[X];Y=new RegExp(Y.substr(0,1)=="^"?Y:("^"+Y.replace(/(\*)/g,".$1").replace(/\?/g,".")+"$"));if(Y.test(Z)){return true}}return false}function l(Z){var ae=Z.protocol,Y;Z.isHost=Z.isHost||t(S.xdm_p);y=Z.hash||false;if(!Z.props){Z.props={}}if(!Z.isHost){Z.channel=S.xdm_c;Z.secret=S.xdm_s;Z.remote=S.xdm_e;ae=S.xdm_p;if(Z.acl&&!V(Z.acl,Z.remote)){throw new Error("Access denied for "+Z.remote)}}else{Z.remote=B(Z.remote);Z.channel=Z.channel||"default"+n++;Z.secret=Math.random().toString(16).substring(2);if(t(ae)){if(j(p.href)==j(Z.remote)){ae="4"}else{if(C(N,"postMessage")||C(d,"postMessage")){ae="1"}else{if(Z.swf&&C(N,"ActiveXObject")&&c()){ae="6"}else{if(navigator.product==="Gecko"&&"frameElement" in N&&navigator.userAgent.indexOf("WebKit")==-1){ae="5"}else{if(Z.remoteHelper){Z.remoteHelper=B(Z.remoteHelper);ae="2"}else{ae="0"}}}}}}}Z.protocol=ae;switch(ae){case"0":T(Z,{interval:100,delay:2000,useResize:true,useParent:false,usePolling:false},true);if(Z.isHost){if(!Z.local){var ac=p.protocol+"//"+p.host,X=d.body.getElementsByTagName("img"),ad;var aa=X.length;while(aa--){ad=X[aa];if(ad.src.substring(0,ac.length)===ac){Z.local=ad.src;break}}if(!Z.local){Z.local=N}}var ab={xdm_c:Z.channel,xdm_p:0};if(Z.local===N){Z.usePolling=true;Z.useParent=true;Z.local=p.protocol+"//"+p.host+p.pathname+p.search;ab.xdm_e=Z.local;ab.xdm_pa=1}else{ab.xdm_e=B(Z.local)}if(Z.container){Z.useResize=false;ab.xdm_po=1}Z.remote=P(Z.remote,ab)}else{T(Z,{channel:S.xdm_c,remote:S.xdm_e,useParent:!t(S.xdm_pa),usePolling:!t(S.xdm_po),useResize:Z.useParent?false:Z.useResize})}Y=[new o.stack.HashTransport(Z),new o.stack.ReliableBehavior({}),new o.stack.QueueBehavior({encode:true,maxLength:4000-Z.remote.length}),new o.stack.VerifyBehavior({initiate:Z.isHost})];break;case"1":Y=[new o.stack.PostMessageTransport(Z)];break;case"2":Y=[new o.stack.NameTransport(Z),new o.stack.QueueBehavior(),new o.stack.VerifyBehavior({initiate:Z.isHost})];break;case"3":Y=[new o.stack.NixTransport(Z)];break;case"4":Y=[new o.stack.SameOriginTransport(Z)];break;case"5":Y=[new o.stack.FrameElementTransport(Z)];break;case"6":if(!i){c()}Y=[new o.stack.FlashTransport(Z)];break}Y.push(new o.stack.QueueBehavior({lazy:Z.lazy,remove:true}));return Y}function D(aa){var ab,Z={incoming:function(ad,ac){this.up.incoming(ad,ac)},outgoing:function(ac,ad){this.down.outgoing(ac,ad)},callback:function(ac){this.up.callback(ac)},init:function(){this.down.init()},destroy:function(){this.down.destroy()}};for(var Y=0,X=aa.length;Y<X;Y++){ab=aa[Y];T(ab,Z,true);if(Y!==0){ab.down=aa[Y-1]}if(Y!==X-1){ab.up=aa[Y+1]}}return ab}function w(X){X.up.down=X.down;X.down.up=X.up;X.up=X.down=null}T(o,{version:"2.4.15.118",query:S,stack:{},apply:T,getJSONObject:O,whenReady:G,noConflict:e});o.DomHelper={on:v,un:x,requiresJSON:function(X){if(!u(N,"JSON")){d.write('<script type="text/javascript" src="'+X+'"><\/script>')}}};(function(){var X={};o.Fn={set:function(Y,Z){X[Y]=Z},get:function(Z,Y){var aa=X[Z];if(Y){delete X[Z]}return aa}}}());o.Socket=function(Y){var X=D(l(Y).concat([{incoming:function(ab,aa){Y.onMessage(ab,aa)},callback:function(aa){if(Y.onReady){Y.onReady(aa)}}}])),Z=j(Y.remote);this.origin=j(Y.remote);this.destroy=function(){X.destroy()};this.postMessage=function(aa){X.outgoing(aa,Z)};X.init()};o.Rpc=function(Z,Y){if(Y.local){for(var ab in Y.local){if(Y.local.hasOwnProperty(ab)){var aa=Y.local[ab];if(typeof aa==="function"){Y.local[ab]={method:aa}}}}}var X=D(l(Z).concat([new o.stack.RpcBehavior(this,Y),{callback:function(ac){if(Z.onReady){Z.onReady(ac)}}}]));this.origin=j(Z.remote);this.destroy=function(){X.destroy()};X.init()};o.stack.SameOriginTransport=function(Y){var Z,ab,aa,X;return(Z={outgoing:function(ad,ae,ac){aa(ad);if(ac){ac()}},destroy:function(){if(ab){ab.parentNode.removeChild(ab);ab=null}},onDOMReady:function(){X=j(Y.remote);if(Y.isHost){T(Y.props,{src:P(Y.remote,{xdm_e:p.protocol+"//"+p.host+p.pathname,xdm_c:Y.channel,xdm_p:4}),name:U+Y.channel+"_provider"});ab=A(Y);o.Fn.set(Y.channel,function(ac){aa=ac;K(function(){Z.up.callback(true)},0);return function(ad){Z.up.incoming(ad,X)}})}else{aa=m().Fn.get(Y.channel,true)(function(ac){Z.up.incoming(ac,X)});K(function(){Z.up.callback(true)},0)}},init:function(){G(Z.onDOMReady,Z)}})};o.stack.FlashTransport=function(aa){var ac,X,ab,ad,Y,ae;function af(ah,ag){K(function(){ac.up.incoming(ah,ad)},0)}function Z(ah){var ag=aa.swf+"?host="+aa.isHost;var aj="easyXDM_swf_"+Math.floor(Math.random()*10000);o.Fn.set("flash_loaded"+ah.replace(/[\-.]/g,"_"),function(){o.stack.FlashTransport[ah].swf=Y=ae.firstChild;var ak=o.stack.FlashTransport[ah].queue;for(var al=0;al<ak.length;al++){ak[al]()}ak.length=0});if(aa.swfContainer){ae=(typeof aa.swfContainer=="string")?d.getElementById(aa.swfContainer):aa.swfContainer}else{ae=d.createElement("div");T(ae.style,h&&aa.swfNoThrottle?{height:"20px",width:"20px",position:"fixed",right:0,top:0}:{height:"1px",width:"1px",position:"absolute",overflow:"hidden",right:0,top:0});d.body.appendChild(ae)}var ai="callback=flash_loaded"+ah.replace(/[\-.]/g,"_")+"&proto="+b.location.protocol+"&domain="+z(b.location.href)+"&port="+f(b.location.href)+"&ns="+I;ae.innerHTML="<object height='20' width='20' type='application/x-shockwave-flash' id='"+aj+"' data='"+ag+"'><param name='allowScriptAccess' value='always'></param><param name='wmode' value='transparent'><param name='movie' value='"+ag+"'></param><param name='flashvars' value='"+ai+"'></param><embed type='application/x-shockwave-flash' FlashVars='"+ai+"' allowScriptAccess='always' wmode='transparent' src='"+ag+"' height='1' width='1'></embed></object>"}return(ac={outgoing:function(ah,ai,ag){Y.postMessage(aa.channel,ah.toString());if(ag){ag()}},destroy:function(){try{Y.destroyChannel(aa.channel)}catch(ag){}Y=null;if(X){X.parentNode.removeChild(X);X=null}},onDOMReady:function(){ad=aa.remote;o.Fn.set("flash_"+aa.channel+"_init",function(){K(function(){ac.up.callback(true)})});o.Fn.set("flash_"+aa.channel+"_onMessage",af);aa.swf=B(aa.swf);var ah=z(aa.swf);var ag=function(){o.stack.FlashTransport[ah].init=true;Y=o.stack.FlashTransport[ah].swf;Y.createChannel(aa.channel,aa.secret,j(aa.remote),aa.isHost);if(aa.isHost){if(h&&aa.swfNoThrottle){T(aa.props,{position:"fixed",right:0,top:0,height:"20px",width:"20px"})}T(aa.props,{src:P(aa.remote,{xdm_e:j(p.href),xdm_c:aa.channel,xdm_p:6,xdm_s:aa.secret}),name:U+aa.channel+"_provider"});X=A(aa)}};if(o.stack.FlashTransport[ah]&&o.stack.FlashTransport[ah].init){ag()}else{if(!o.stack.FlashTransport[ah]){o.stack.FlashTransport[ah]={queue:[ag]};Z(ah)}else{o.stack.FlashTransport[ah].queue.push(ag)}}},init:function(){G(ac.onDOMReady,ac)}})};o.stack.PostMessageTransport=function(aa){var ac,ad,Y,Z;function X(ae){if(ae.origin){return j(ae.origin)}if(ae.uri){return j(ae.uri)}if(ae.domain){return p.protocol+"//"+ae.domain}throw"Unable to retrieve the origin of the event"}function ab(af){var ae=X(af);if(ae==Z&&af.data.substring(0,aa.channel.length+1)==aa.channel+" "){ac.up.incoming(af.data.substring(aa.channel.length+1),ae)}}return(ac={outgoing:function(af,ag,ae){Y.postMessage(aa.channel+" "+af,ag||Z);if(ae){ae()}},destroy:function(){x(N,"message",ab);if(ad){Y=null;ad.parentNode.removeChild(ad);ad=null}},onDOMReady:function(){Z=j(aa.remote);if(aa.isHost){var ae=function(af){if(af.data==aa.channel+"-ready"){Y=("postMessage" in ad.contentWindow)?ad.contentWindow:ad.contentWindow.document;x(N,"message",ae);v(N,"message",ab);K(function(){ac.up.callback(true)},0)}};v(N,"message",ae);T(aa.props,{src:P(aa.remote,{xdm_e:j(p.href),xdm_c:aa.channel,xdm_p:1}),name:U+aa.channel+"_provider"});ad=A(aa)}else{v(N,"message",ab);Y=("postMessage" in N.parent)?N.parent:N.parent.document;Y.postMessage(aa.channel+"-ready",Z);K(function(){ac.up.callback(true)},0)}},init:function(){G(ac.onDOMReady,ac)}})};o.stack.FrameElementTransport=function(Y){var Z,ab,aa,X;return(Z={outgoing:function(ad,ae,ac){aa.call(this,ad);if(ac){ac()}},destroy:function(){if(ab){ab.parentNode.removeChild(ab);ab=null}},onDOMReady:function(){X=j(Y.remote);if(Y.isHost){T(Y.props,{src:P(Y.remote,{xdm_e:j(p.href),xdm_c:Y.channel,xdm_p:5}),name:U+Y.channel+"_provider"});ab=A(Y);ab.fn=function(ac){delete ab.fn;aa=ac;K(function(){Z.up.callback(true)},0);return function(ad){Z.up.incoming(ad,X)}}}else{if(d.referrer&&j(d.referrer)!=S.xdm_e){N.top.location=S.xdm_e}aa=N.frameElement.fn(function(ac){Z.up.incoming(ac,X)});Z.up.callback(true)}},init:function(){G(Z.onDOMReady,Z)}})};o.stack.NameTransport=function(ab){var ac;var ae,ai,aa,ag,ah,Y,X;function af(al){var ak=ab.remoteHelper+(ae?"#_3":"#_2")+ab.channel;ai.contentWindow.sendMessage(al,ak)}function ad(){if(ae){if(++ag===2||!ae){ac.up.callback(true)}}else{af("ready");ac.up.callback(true)}}function aj(ak){ac.up.incoming(ak,Y)}function Z(){if(ah){K(function(){ah(true)},0)}}return(ac={outgoing:function(al,am,ak){ah=ak;af(al)},destroy:function(){ai.parentNode.removeChild(ai);ai=null;if(ae){aa.parentNode.removeChild(aa);aa=null}},onDOMReady:function(){ae=ab.isHost;ag=0;Y=j(ab.remote);ab.local=B(ab.local);if(ae){o.Fn.set(ab.channel,function(al){if(ae&&al==="ready"){o.Fn.set(ab.channel,aj);ad()}});X=P(ab.remote,{xdm_e:ab.local,xdm_c:ab.channel,xdm_p:2});T(ab.props,{src:X+"#"+ab.channel,name:U+ab.channel+"_provider"});aa=A(ab)}else{ab.remoteHelper=ab.remote;o.Fn.set(ab.channel,aj)}ai=A({props:{src:ab.local+"#_4"+ab.channel},onLoad:function ak(){var al=ai||this;x(al,"load",ak);o.Fn.set(ab.channel+"_load",Z);(function am(){if(typeof al.contentWindow.sendMessage=="function"){ad()}else{K(am,50)}}())}})},init:function(){G(ac.onDOMReady,ac)}})};o.stack.HashTransport=function(Z){var ac;var ah=this,af,aa,X,ad,am,ab,al;var ag,Y;function ak(ao){if(!al){return}var an=Z.remote+"#"+(am++)+"_"+ao;((af||!ag)?al.contentWindow:al).location=an}function ae(an){ad=an;ac.up.incoming(ad.substring(ad.indexOf("_")+1),Y)}function aj(){if(!ab){return}var an=ab.location.href,ap="",ao=an.indexOf("#");if(ao!=-1){ap=an.substring(ao)}if(ap&&ap!=ad){ae(ap)}}function ai(){aa=setInterval(aj,X)}return(ac={outgoing:function(an,ao){ak(an)},destroy:function(){N.clearInterval(aa);if(af||!ag){al.parentNode.removeChild(al)}al=null},onDOMReady:function(){af=Z.isHost;X=Z.interval;ad="#"+Z.channel;am=0;ag=Z.useParent;Y=j(Z.remote);if(af){Z.props={src:Z.remote,name:U+Z.channel+"_provider"};if(ag){Z.onLoad=function(){ab=N;ai();ac.up.callback(true)}}else{var ap=0,an=Z.delay/50;(function ao(){if(++ap>an){throw new Error("Unable to reference listenerwindow")}try{ab=al.contentWindow.frames[U+Z.channel+"_consumer"]}catch(aq){}if(ab){ai();ac.up.callback(true)}else{K(ao,50)}}())}al=A(Z)}else{ab=N;ai();if(ag){al=parent;ac.up.callback(true)}else{T(Z,{props:{src:Z.remote+"#"+Z.channel+new Date(),name:U+Z.channel+"_consumer"},onLoad:function(){ac.up.callback(true)}});al=A(Z)}}},init:function(){G(ac.onDOMReady,ac)}})};o.stack.ReliableBehavior=function(Y){var aa,ac;var ab=0,X=0,Z="";return(aa={incoming:function(af,ad){var ae=af.indexOf("_"),ag=af.substring(0,ae).split(",");af=af.substring(ae+1);if(ag[0]==ab){Z="";if(ac){ac(true)}}if(af.length>0){aa.down.outgoing(ag[1]+","+ab+"_"+Z,ad);if(X!=ag[1]){X=ag[1];aa.up.incoming(af,ad)}}},outgoing:function(af,ad,ae){Z=af;ac=ae;aa.down.outgoing(X+","+(++ab)+"_"+af,ad)}})};o.stack.QueueBehavior=function(Z){var ac,ad=[],ag=true,aa="",af,X=0,Y=false,ab=false;function ae(){if(Z.remove&&ad.length===0){w(ac);return}if(ag||ad.length===0||af){return}ag=true;var ah=ad.shift();ac.down.outgoing(ah.data,ah.origin,function(ai){ag=false;if(ah.callback){K(function(){ah.callback(ai)},0)}ae()})}return(ac={init:function(){if(t(Z)){Z={}}if(Z.maxLength){X=Z.maxLength;ab=true}if(Z.lazy){Y=true}else{ac.down.init()}},callback:function(ai){ag=false;var ah=ac.up;ae();ah.callback(ai)},incoming:function(ak,ai){if(ab){var aj=ak.indexOf("_"),ah=parseInt(ak.substring(0,aj),10);aa+=ak.substring(aj+1);if(ah===0){if(Z.encode){aa=k(aa)}ac.up.incoming(aa,ai);aa=""}}else{ac.up.incoming(ak,ai)}},outgoing:function(al,ai,ak){if(Z.encode){al=H(al)}var ah=[],aj;if(ab){while(al.length!==0){aj=al.substring(0,X);al=al.substring(aj.length);ah.push(aj)}while((aj=ah.shift())){ad.push({data:ah.length+"_"+aj,origin:ai,callback:ah.length===0?ak:null})}}else{ad.push({data:al,origin:ai,callback:ak})}if(Y){ac.down.init()}else{ae()}},destroy:function(){af=true;ac.down.destroy()}})};o.stack.VerifyBehavior=function(ab){var ac,aa,Y,Z=false;function X(){aa=Math.random().toString(16).substring(2);ac.down.outgoing(aa)}return(ac={incoming:function(af,ad){var ae=af.indexOf("_");if(ae===-1){if(af===aa){ac.up.callback(true)}else{if(!Y){Y=af;if(!ab.initiate){X()}ac.down.outgoing(af)}}}else{if(af.substring(0,ae)===Y){ac.up.incoming(af.substring(ae+1),ad)}}},outgoing:function(af,ad,ae){ac.down.outgoing(aa+"_"+af,ad,ae)},callback:function(ad){if(ab.initiate){X()}}})};o.stack.RpcBehavior=function(ad,Y){var aa,af=Y.serializer||O();var ae=0,ac={};function X(ag){ag.jsonrpc="2.0";aa.down.outgoing(af.stringify(ag))}function ab(ag,ai){var ah=Array.prototype.slice;return function(){var aj=arguments.length,al,ak={method:ai};if(aj>0&&typeof arguments[aj-1]==="function"){if(aj>1&&typeof arguments[aj-2]==="function"){al={success:arguments[aj-2],error:arguments[aj-1]};ak.params=ah.call(arguments,0,aj-2)}else{al={success:arguments[aj-1]};ak.params=ah.call(arguments,0,aj-1)}ac[""+(++ae)]=al;ak.id=ae}else{ak.params=ah.call(arguments,0)}if(ag.namedParams&&ak.params.length===1){ak.params=ak.params[0]}X(ak)}}function Z(an,am,ai,al){if(!ai){if(am){X({id:am,error:{code:-32601,message:"Procedure not found."}})}return}var ak,ah;if(am){ak=function(ao){ak=q;X({id:am,result:ao})};ah=function(ao,ap){ah=q;var aq={id:am,error:{code:-32099,message:ao}};if(ap){aq.error.data=ap}X(aq)}}else{ak=ah=q}if(!r(al)){al=[al]}try{var ag=ai.method.apply(ai.scope,al.concat([ak,ah]));if(!t(ag)){ak(ag)}}catch(aj){ah(aj.message)}}return(aa={incoming:function(ah,ag){var ai=af.parse(ah);if(ai.method){if(Y.handle){Y.handle(ai,X)}else{Z(ai.method,ai.id,Y.local[ai.method],ai.params)}}else{var aj=ac[ai.id];if(ai.error){if(aj.error){aj.error(ai.error)}}else{if(aj.success){aj.success(ai.result)}}delete ac[ai.id]}},init:function(){if(Y.remote){for(var ag in Y.remote){if(Y.remote.hasOwnProperty(ag)){ad[ag]=ab(Y.remote[ag],ag)}}}aa.down.init()},destroy:function(){for(var ag in Y.remote){if(Y.remote.hasOwnProperty(ag)&&ad.hasOwnProperty(ag)){delete ad[ag]}}aa.down.destroy()}})};b.easyXDM=o})(window,document,location,window.setTimeout,decodeURIComponent,encodeURIComponent);



/**************************************************************************
 * jquery.themepunch.kenburn.js - jQuery Plugin for kenburn Slider
 * @version: 1.4.6 (12.09.2012)
 * @requires jQuery v1.4.2 or later 
 * @author ThemePunch
**************************************************************************/


/*********************************************************

Version 1.4.4 (20.08.2012)

 - Major Chrome Canvas Bug has been fixed


Pre Versions  -> Version 1.4.3 

Bug Fixing 16.05.2012

	-	Plugin Conflicts has been solved within the cssAnimation Plugin
	-	Google Chrome Bug / Fade Transition Bug 09.05.2012

The lates GoogleChrome Update (18.0.1025.168) has some Bug in the Canvas Rendering. 
	-	Due this Bug the Fade Over transition will not work fine between the slides. You will see some Flickering by changing between slides with fade Transitions. 
		Since this problem does not exist in IE or in FF we can only provide you a small workaround where the Plugin automatically ignore fade transitions in Google Chrome. 
		If you interested, please download our next update !

	-	Via the option repairChromeBug:?on? you can decide whenever you wish to change automatically the fade transition against slide transition in Chrome.
		Thanks a lot, and if you have any question, please do not hesitate to contact us via http://themepunch.ticksy.com !

Additional Feature Update from 8th of March 2012 :

	-	Responsive Function Extended with Proportional Image Resizing function.
	-	KenBurn function Turn on/off Option added per Slide.
	-	Additional Feature and Bug Fixing Update from 1st of March 2012 :

	-	Responsive Function Extended with Full Proportional Sensibility. Height will be set Automatically dependend on Start Height and Start Width Proportions.
	-	Removing Captions Bug Fixed
	-	Hide Thumbnails on/off Bug Fixed
	-	Optional Bulletpoint Toolbar

*******************************************************/



(function($,undefined){	
    ////////////////////////////
    // THE PLUGIN STARTS HERE //
    ////////////////////////////
	
    $.fn.extend({
	
		
        // OUR PLUGIN HERE :)
        kenburn: function(options) {
	
		
			
            ////////////////////////////////
            // SET DEFAULT VALUES OF ITEM //
            ////////////////////////////////
            var defaults = {	
			
                adjustToWindowSize:"on",
                trackWindowResize:"on",
                responsive:"on",
                blurwrap: "on",
                noresponsiveWidth:600,
                noresponsiveHeight:300,
                fixHeight:false,
                thumbWidth:50,
                thumbHeight:50,
                thumbAmount:6,			
                thumbStyle:"bullet",		// bullet, image,none
                thumbXOffset:0,
                thumbYOffsetm:0,
                bulletXOffset:0,
                bulletYOffset:0,
                shadow:'true',			
                timer:2000,
                touchenabled:"on",
                pauseOnRollOverThumbs:'off',
                pauseOnRollOverMain:'on',
                preloadedSlides:50,
                googleFonts:'PT+Sans+Narrow:400,700',
                googleFontJS:'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js',
                debug:"no",
                rescaleBGColor:"#333",
                buttonsArrows: 'on'
            };
		
            options = $.extend({}, $.fn.kenburn.defaults, options);
		
            WebFontConfig = {
                google: {
                    families: [ options.googleFonts ]
                },
                active: function() {
                    jQuery('body').data('googlefonts','loaded');
                },
                inactive: function() {
                    jQuery('body').data('googlefonts','loaded');
                }
            };
					
            return this.each(function() {
							
                var opt=options;
                if (opt.vCorrection==undefined) opt.vCorrection=10;
                if (opt.hCorrection==undefined) opt.hCorrection=10;
				
                if (opt.debug=="yes" || opt.debug=="on")
                    $('body').append('<div class="testinfo" style="z-index:99999;position:fixed;background:#000;color:#fff;width:700px;height:200px;top:10px;left:10px;"></div>');
				
                // GOOGLE FONT HANDLING
                if (opt.googleFonts!=undefined && opt.googleFonts.length>0) {
                    var wf = document.createElement('script');
                    wf.src = opt.googleFontJS;
                    wf.type = 'text/javascript';
                    wf.async = 'true';
                    var s = document.getElementsByTagName('script')[0];
                    s.parentNode.insertBefore(wf, s);
                    jQuery('body').data('googlefonts','wait');
                } else {
                    jQuery('body').data('googlefonts','loaded');
                }
				
                opt.savedTimer=opt.timer;
                var top_container=$(this);
                if (top_container.attr('id') == undefined) top_container.attr('id',Math.round(Math.random()*100000));
				
                top_container.find('ul').show();

                var minW = top_container.css('minWidth');
                var maxW = top_container.css('maxWidth');
                opt.whproportion =  parseInt(top_container.css('height'),0) / parseInt(top_container.css('maxWidth'),0);
				
                opt.width=top_container.width()-opt.hCorrection;	
                opt.height = top_container.height()-opt.vCorrection;				
				
                if (!opt.fixHeight || !opt.fixHeight=="true") {
                    opt.height=opt.width * opt.whproportion;
                }
				
                opt.originalwidth = parseInt(top_container.css('maxWidth'),0);
                opt.originalheight = parseInt(top_container.css('height'),0);
				
                if (!opt.fixHeight || !opt.fixHeight=="true") {
                    opt._propw = opt.width / opt.originalwidth;
                    opt._proph = opt.height / opt.originalheight;
                } else {
                    opt._propw = 1;
                    opt._proph = 1;
                }
									
                top_container.height(opt.height+opt.vCorrection);
				
                //opt.height=top_container.height()-10;
                opt.oldid="responsive"+top_container.attr('id');
				
                top_container.wrap('<div id="'+opt.oldid+'" class="responsiveholder"></div>');											
                opt.fullHTML=$('body').find('#'+opt.oldid).html();
				
				
                var responsive = true;
                if (minW==maxW || maxW=="none") responsive=false;
				
                if (opt.responsive=="off") {
                    responsive=false;
                    opt.width = opt.noResponsiveWidth;
                    opt.height = opt.noResponsiveHeight;
                }
				
				
                if (opt.width<500 && responsive && !opt.fixHeight) {
                    opt._propw = opt._propw*1.7;
                    opt._proph = opt._proph*1.7;
                }
				
				
                // HERE WE GO TO START PREPARE EVERYTHING
                startToPrepare(top_container,opt);
                opt.videoWasOn=-1;
				
                // Create Responsive Listener
                if (responsive && opt.trackWindowResize == 'on') {

                    $(window).resize(function() {
					
                        if (top_container.find('.videoon').length>0 && opt.videoWasOn==-1) {
                            opt.videoWasOn=1 
                        } else {
                            if (opt.videoWasOn==-1) opt.videoWasOn=0;
                        }
						
                        clearInterval(opt.aktKenInterval);
                        clearInterval(opt.timerinterval);
                        clearInterval(opt.waitForWF);
                        clearTimeout(opt.resetAll);
					
                        opt.width=top_container.width()-opt.hCorrection;		
                        if (!opt.fixHeight || !opt.fixHeight=="true")	{
						
                            opt.height=opt.width * opt.whproportion;
                            opt._propw = opt.width / opt.originalwidth;
                            opt._proph = opt.height / opt.originalheight;
                        }
					
					
					
										
                        if (opt.width<500 && responsive && !opt.fixHeight) {
                            opt._propw = opt._propw*1.7;
                            opt._proph = opt._proph*1.7;
                        }
                        opt.preloadedSlides=200;
					
                        top_container.empty();
                        top_container.remove();									
					
					
                        $('body').find('#'+opt.oldid).append(opt.fullHTML);										
                        top_container=$('body').find('#'+opt.oldid).find('div:first');					
                        top_container.height(opt.height+opt.vCorrection);
                        opt.resetAll = setTimeout(function() {
                            startToPrepare(top_container,opt);
                        },200);
					
                    });
                }
            })
        }
    })
		
    ///////////////////////////////
    //  --  LOCALE FUNCTIONS -- //
    ///////////////////////////////
		
    function startToPrepare(top_container,opt) {
					
        // DEBUGGING INFORMATIONS HERE
        if (opt.debug==="on")
            $('body').append('<div class="khinfo" style="background:#fff;color:#000;width:300px;height:250px;position:fixed;left:10px;top:10px;"></div>');
        //top_container.css({'width':opt.width+"px",'height':opt.height+"px"});
								
        top_container.append('<div class="kenburn-preloader"></div>');
        
								
        prepareSlidesContainer(top_container,opt);
        
								
        prepareSlides(top_container,opt);
        
																
        
        opt.loadedImages=0;
        top_container.waitForImages(
            function() {   
                
                opt.waitForWF = setInterval(function() {
											
                    
															
                    // IF THE GOOGLE FONT IS LOADED WE CAN START TO ROTATE THE IMAGES
                    if (!opt.googleFonts.length || ($('body').data('googlefonts') != undefined && $('body').data('googlefonts')=="loaded")) {
                    //if ($('body').data('googlefonts') != undefined && $('body').data('googlefonts')=="loaded") {
															
                        opt.lastThumb=opt.currentThumb;
                        // CREATE THE THUMBNAILS HERE
                        if (opt.thumbStyle=="image" || opt.thumbStyle=="both" || opt.thumbStyle=="thumb")
                            createThumbnails(top_container,opt);				
																 
                        if (opt.thumbStyle=="bullet" || opt.thumbStyle=="both")
                            createBullets(top_container,opt);
																	
																	
                        
                        clearInterval(opt.waitForWF);
																
																
                        startRotation(top_container,opt);																
																
                        
                        prepareRestSlides(top_container,opt);										
                        if (opt.thumbStyle=="both") top_container.find('.thumbbuttons').css({
                            'visibility':'hidden'
                        });
                        top_container.css({
                            'background-color':'transparent'
                        });
																
                    /*if (opt.lastThumb != undefined) {																																	
																	var thumb = top_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+opt.lastThumb);
																	thumb.click();
																} */
																
																
																
                    }
                },10);				
            }, 
            function() {
                
                opt.loadedImages=opt.loadedImages+1;
            });
								
								
        startTimer(top_container,opt);
									
        // TOUCH ENABLED SCROLL
        if (opt.touchenabled=="on")
										
            top_container.swipe( {
                data:top_container, 
                swipeLeft:function() 
                { 
                    var newitem = top_container.data('currentSlide');	
                    if (newitem.index()<opt.maxitem-1) {
                        var next=top_container.find('ul li:eq('+(newitem.index()+1)+')');
                    } else {
                        var next=top_container.find('ul li:first');
                    }
                    swapBanner(newitem,next,top_container,opt);
                }, 
                swipeRight:function() 
                {
                    var newitem = top_container.data('currentSlide');	
                    if (newitem.index()>0) {
                        var next=top_container.find('ul li:eq('+(newitem.index()-1)+')');
                    } else {
                        var next=top_container.find('ul li:eq('+(opt.maxitem-1)+')');
                    }
                    swapBanner(newitem,next,top_container,opt);
                }, 
                allowPageScroll:"auto"
            } );
							
    }
					
    ///////////////////////////////////////////
    //	--	Set the Containers of Slides --	 //
    ///////////////////////////////////////////
					
					
    function prepareSlides(top,opt) {
        top.find('iframe').attr("frameborder",0);						
	
        top.find('ul').wrap('<div class="slide_mainmask" style="z-index:10;position:absolute;top:'+(opt.padtop+opt.botop)+'px;left:'+(opt.padleft+opt.boleft)+'px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"></div>');
        top.find('ul .slide_mainmask').css({
            'opacity':'0.0'
        });
						
        opt.maxitem=0;
        top.find('ul >li').each(function(i) {
            opt.maxitem=opt.maxitem+1;
            var $this=$(this);
            var img = $this.find('img:first');
            img.data('src',img.attr('src'));
            img.attr('src',"");
        });
						
        for (var i=0;i<opt.preloadedSlides;i++) {
            prepareSlide(top,opt,i);
        }
    }
					
					
    ////////////////////////////////////
    // Prepare THe Rest of the Slides //
    ///////////////////////////////////
    function prepareRestSlides(top,opt) {
        for (var i=opt.preloadedSlides;i<opt.maxitem;i++) {
            prepareSlide(top,opt,i);
								
        }
    }
					
					
    //////////////////////////////
    // PREPARE SLIDE ONE BY ONE //
    //////////////////////////////
    function prepareSlide(top,opt,nr) {						
						
        top.find('ul >li').each(function(i) {
            if (i==nr) {
                var $this = $(this);
                $this.find('.creative_layer').wrap('<div class="layer_container" style="position:absolute;left:0px;top:0px;width:'+opt.width+'px;height:'+opt.height+'px"></div>');
                // SET THE SIZES OD THE CAPTIONS DEPENDING ON THE BROWSER SIZE
                top.removeClass('kb-minisize').removeClass('kb-halfsize').removeClass('kb-fullsize');
										
                if (opt.adjustToWindowSize == 'on') {
                    if ($(window).width()<=570)
                        top.addClass('kb-minisize');
                    else
                    if ($(window).width()<=767) 
                        top.addClass('kb-smallsize');
                    else 
                    if ($(window).width()<=959)
                        top.addClass('kb-mediumsize');
                    else
                    if ($(window).width()>959)
                        top.addClass('kb-fullsize');
                } else {
                    top.addClass('kb-fullsize');
                }
										
										
										
										
                $this.wrapInner('<div class="slide_container" style="z-index:10;position:absolute;top:0px;left:0px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"><div class="parallax_container" style="position:absolute;top:0pxleft:0px"><div class="kb_container"></div></div></div>');
										
                var ie_old = ( $.browser.msie ) && ($.browser.version<9);
										
                // PREPARE THE BLACK AND WHITE IMAGES HERE
                if ($this.find('img:first').data('bw') != undefined && $this.find('img:first').data('bw').length>0 && !ie_old )
                    $this.find('.kb_container').append('<img class="bw-main-image" src="'+$this.find('img:first').data('bw')+'" style="position:absolute;top:0px;left:0px">');
					
                $this.find('img:first').attr('src',$this.find('img:first').data('src'));
                /******************************* 
										################################
											THE STRUCTUE:
											
											->slide_container
												->parallax_container	
													->kb_container
										################################
										********************************/
                $this.find('.slide_container').css({
                    'opacity':'0.0'
                });
										
                $this.find('.slide_container .parallax_container .kb_container .video_kenburner').each(function() {
                    var $this=$(this);
                    $this.closest('.slide_container').append('<div class="kenburn-video-overlay"></div>');								
                    $this.closest('.slide_container').append('<div class="kenburn-video-button"></div>');	
											
                    $this.closest('.slide_container').data('video',1);
											
                    var pbutton = $this.closest('.slide_container').parent().find('.kenburn-video-button');
                    var over = $this.closest('.slide_container').parent().find('.kenburn-video-overlay');
                    var _width  = parseInt(pbutton.css('width'),0);
                    var _height = parseInt(pbutton.css('height'),0);
                    var mwidth  = parseInt($this.closest('.slide_container').css('width'),0);
                    var mheight = parseInt($this.closest('.slide_container').css('height'),0);
											
                    pbutton.css({
                        'left':(mwidth/2-_width/2)+'px',
                        'top':(mheight/2-_height/2)+'px'
                        });
                    pbutton.data('top',top);
                    pbutton.data('url',$this.html());
                    $this.remove();
                    over.data('origopa',over.css('opacity'));
											
											
                    // VIDEO IS DEFINED, SO HOVER ON VIDEO BUTTON SHOULD MAKE SOME EFFECT
                    pbutton.hover(
                        function() {
														
                            var $this = $(this);																					
                            var $over = $this.parent().find('.kenburn-video-overlay');											
                            if ( $.browser.msie )
                                $over.animate({
                                    'opacity':'0.5'
                                },{
                                    duration:100
                                });
                            else
                                $over.cssAnimate({
                                    'opacity':'0.5'
                                },{
                                    duration:100
                                });
														
                            if ($.browser.version > 7 && $.browser.version < 9) {											
                                $over.css({
                                    'display':'block'
                                });
                            }
                        }, 
                        function() {
                            var $this = $(this);											
                            var $over = $this.parent().find('.kenburn-video-overlay');
														
                            if ( $.browser.msie )
                                $over.animate({
                                    'opacity':$over.data('origopa')
                                    },{
                                    duration:100
                                });
                            else
                                $over.cssAnimate({
                                    'opacity':$over.data('origopa')
                                    },{
                                    duration:100
                                });
														
                            if ($.browser.msie && $.browser.version > 7 && $.browser.version < 9) {												
                                $over.css({
                                    'display':'none'
                                });
                            }
                        });
												
                    // VIDEO IS DEFINED, SO CLICK ON VIDEO BUTTON SHOULD START TO PLAY THE VIDEO HERE
                    pbutton.click(
                        function() {
                            var $this=$(this);			
                            var top=$this.data('top');
                            var slidemask = top.find('.slide_mainmask');
                            slidemask.addClass("videoon");
                            top.data('currentSlide').animate({
                                'top':opt.height+"px"
                                },{
                                duration:500,
                                queue:false
                            });										
													
                            top.find('.slide_mainmask').append('<div class="video_kenburn" style="z-index:9999;width:'+opt.width+'px;height:'+opt.height+'px">'+$this.data('url')+'</div>');
                            var video = top.find('.slide_mainmask .video_kenburn');
                            video.css({
                                'top':(0-opt.height)+"px"
                                });
                            if (opt.videoWasOn==1) 
                                video.animate({
                                    'top':'0px'
                                },{
                                    duration:0,
                                    queue:false
                                });		
                            else
                                video.animate({
                                    'top':'0px'
                                },{
                                    duration:500,
                                    queue:false
                                });		
											
                            video.find('* .close').click(
                                function() {
															
                                    var slidemask = top.find('.slide_mainmask');
                                    slidemask.removeClass("videoon");
                                    top.data('currentSlide').animate({
                                        'top':"0px"
                                    },{
                                        duration:600,
                                        queue:false
                                    });																																										
                                    video.animate({
                                        'top':(0-opt.height)+'px'
                                        },{
                                        duration:600,
                                        queue:false
                                    });		
                                    setTimeout(function() {
                                        video.remove()
                                        },600);
                                });
                        });
											
                });
            }
        });
    }
					
					
    ////////////////////////////////////////////////
    //	--	BACKGROUND AND DEFAULT VALUES --	 //
    //////////////////////////////////////////////
    function prepareSlidesContainer(top,opt) {
        top.append('<div class="kenburn-bg" style="z-index:7;position:absolute;top:0px;left:0px;width:'+opt.width+'px;height:'+opt.height+'px;overflow:hidden"></div>');
        var bg=top.find('.kenburn-bg');
						
        opt.padtop=0;
        opt.padleft=0;
        opt.padright=0;
        opt.padbottom=0;
						
        opt.botop=0;
        opt.boleft=0;
        opt.boright=0;
        opt.bobottom=0;
						
						
        if ($.browser.msie) {
            if (bg.css('paddingTop') !=undefined && bg.css('paddingTop') !=null && bg.css('paddingTop').length>0) {
                opt.padtop=parseInt(bg.css('paddingTop'),0);
                top.css('paddingTop', parseInt(bg.css('paddingTop'))+1);
            }
			
            if (bg.css('paddingLeft') !=undefined && bg.css('paddingLeft') !=null && bg.css('paddingLeft').length>0) {
                opt.padleft=parseInt(bg.css('paddingLeft'),0);
                top.css('paddingLeft', parseInt(bg.css('paddingLeft'))+1);
            }
							
            if (bg.css('paddingRight') !=undefined && bg.css('paddingRight') !=null)									
                if (bg.css('paddingRight').length>0)
                    opt.padright=parseInt(bg.css('paddingRight'),0);
							
            if (bg.css('paddingBottom') !=undefined && bg.css('paddingBottom') !=null)			
                if (bg.css('paddingBottom').length>0)
                    opt.padbottom=parseInt(bg.css('paddingBottom'),0);						
							
            if (bg.css('borderTopWidth') !=undefined && bg.css('borderTopWidth') !=null) 
                if (bg.css('borderTopWidth').length>0)
                    opt.botop=parseInt(bg.css('borderTopWidth'),0);
							
            if (bg.css('borderLeftWidth') !=undefined && bg.css('borderLeftWidth') !=null)
                if (bg.css('borderLeftWidth').length>0)	
                    opt.boleft=parseInt(bg.css('borderLeftWidth'),0);
							
            if (bg.css('borderRightWidth') !=undefined && bg.css('borderRightWidth') !=null)
                if (bg.css('borderRightWidth').length>0)	
                    opt.boright=parseInt(bg.css('borderRightWidth'),0);
							
            if (bg.css('borderBottomWidth') !=undefined && bg.css('borderBottomWidth') !=null)
                if (bg.css('borderBottomWidth').length>0)
                    opt.bobottom=parseInt(bg.css('borderBottomWidth'),0);						
        } else {
            if (bg.css('paddingTop').length>0)
                opt.padtop=parseInt(bg.css('paddingTop'),0);
							
            if (bg.css('paddingLeft').length>0)	
                opt.padleft=parseInt(bg.css('paddingLeft'),0);
							
            if (bg.css('paddingRight').length>0)
                opt.padright=parseInt(bg.css('paddingRight'),0);
							
            if (bg.css('paddingBottom').length>0)
                opt.padbottom=parseInt(bg.css('paddingBottom'),0);						
							
            if (bg.css('borderTopWidth').length>0)
                opt.botop=parseInt(bg.css('borderTopWidth'),0);
							
            if (bg.css('borderLeftWidth').length>0)	
                opt.boleft=parseInt(bg.css('borderLeftWidth'),0);
							
            if (bg.css('borderRightWidth').length>0)	
                opt.boright=parseInt(bg.css('borderRightWidth'),0);
							
            if (bg.css('borderBottomWidth').length>0)
                opt.bobottom=parseInt(bg.css('borderBottomWidth'),0);						
        }				
    }										
					
    ///////////////////////////
    // CREATE THE THUMBNAILS //
    //////////////////////////
    function createThumbnails(top,opt) {
						
        var maxitem = top.find('ul >li').length;
						
											
        // CALCULATE THE MAX WIDTH OF THE THUMB HOLDER
        var maxwidth = opt.thumbAmount * opt.thumbWidth;
        opt.thumbmaxwidth=maxwidth;
        var maxheight = opt.thumbHeight;
						
        var bgwidth = maxwidth;
        var bgheight = maxheight;
        var full = opt.width + opt.padleft + opt.padright;
        var centerl = Math.round(full /2 - bgwidth/2);
        var max= (maxitem * opt.thumbWidth);
						
						
        // CREATE THE BACKGROUND 1 PIXEL ROUND BG 
        top.append('<div class="kenburn_thumb_container" style="position:absolute;left:'+centerl+'px;top:'+(1+opt.height+opt.padtop+opt.padbottom)+'px;width:'+(bgwidth+2)+'px;height:'+(bgheight+2)+'px;"></div>');
						
        // CREATE THE WHITE HOLDER
        var thc=top.find('.kenburn_thumb_container');
        if (opt.hideThumbs=="on") thc.css({
            'opacity':0
        });
						
        if (opt.thumbAmount==0) thc.css({
            'visibility':'hidden'
        });
        thc.append('<div class="kenburn_thumb_container_bg" style="position:absolute;left:1px;top:0px;width:'+(bgwidth)+'px;height:'+(bgheight)+'px"></div>');
						
						
        // CREATE THE MASK INSIDE
        thc.append('<div id="thumbmask" style="overflow:hidden;position:absolute;top:0px;left:1px; width:'+maxwidth+'px;	height:'+opt.thumbHeight+'px;overflow:hidden;"></div>');					
        var thma=thc.find('#thumbmask');							
        // CREATE THE SLIDER CONTAINER
        thma.append('<div class="thumbsslide" style="width:'+max+'px"></div>');										
        var thbg=thma.find('.thumbsslide');
						
        thc.hover(
            function() {
                $(this).addClass('overme');
                opt.overme = 'on';
                thc.animate({
                    'opacity':1
                },{
                    duration:300,
                    queue:false
                });
            }, 
            function() {
                $(this).removeClass('overme');
                opt.overme = 'off';
                var sm = top.find('.slide_mainmask');
				
                setTimeout(function() {
                    if (opt.hideThumbs=="on" && !sm.hasClass('overon') && !$('body').hasClass('tp_showthumbsalways')) {
                        thc.animate({
                            'opacity':0
                        },{
                            duration:300,
                            queue:false
                        });
                    }
                },10);
            });
						
        /**********************************************
						##############################################
								STRUCTURE OF THUMBNAILS
							
							->.kenburn_thumb_container
									->#thumbmask
										->.thumbsslide
											->thumb (thumb"i")
							->.kenburn_thumb_container_bg
							
						##############################################
						*********************************************/
											
        // GO THROUGHT THE ITEMS, AND CREATE AN THUMBNAIL AS WE NEED
        top.find('ul >li').each(function(i) {
									
            var $this=$(this);
									
            // READ OUT THE DATA INFOS
            var img=$this.find('img:first');
									
            var src=img.data('thumb');
            var isvideo = $this.find('.slide_container').data('video')==1;
									
            // CREATE THE THUMBS
            var thumb=$('<div class="kenburn-thumbs" id="thumb'+i+'" style="cursor:pointer;position:absolute;top:0px;left:'+(i*opt.thumbWidth)+'px;width:'+opt.thumbWidth+'px;height:'+opt.thumbHeight+'px;background:url('+src+');"></div>');																	
            thumb.data('id',i);
									
            var overlay=$('<div class="overlay"></div>');
            thumb.append(overlay);
									
            if (i==maxitem)	thumb.css({
                'margin-right':'0px'
            });							
							
            thbg.append(thumb);
																		
            if (i==opt.lastThumb) {
                thumb.addClass("selected");
                thumb.find('.overlay').css({
                    'opacity':0
                });
										
            } else {
                thumb.find('.overlay').css({
                    'opacity':0.75
                });
                thumb.removeClass("selecte");
            }
									
									
									
            // CREATE VIDEO BUTTON ON THE THUMBNAIL
            if (isvideo && opt.thumbVideoIcon=="on") {
                var new_video=$('<div class="video"></div>');
                thumb.append(new_video);									
                thumb.find('.video').css({
                    'position':'absolute',
                    'top':opt.thumbHeight/2+'px',
                    'left':opt.thumbWidth/2+'px',
                    'z-index':'1000'
                });
            }
										
										 
									
									
									
            ///////////////////////////////////////
            // SHOW THE COLORED THUMBNAIL HERE  //
            //////////////////////////////////////
            var thumbnail = thbg.find('#thumb'+i);
            thumbnail.hover(
                function() {
											
                    var thumb = $(this);
                    thumb.stop();
                    thumb.find('.overlay').animate({
                        'opacity':0
                    },{
                        duration:300,
                        queue:false
                    });
                },
                function() {
                    var thumb = $(this);
                    thumb.stop();
                    if (!thumb.hasClass('selected'))
                        thumb.find('.overlay').animate({
                            'opacity':0.75
                        },{
                            duration:300,
                            queue:false
                        });
                });
									
            thumbnail.click(function() {
                var $this=$(this);
										
                if (($this.position().left+opt.thumbWidth) == opt.thumbmaxwidth && $this.index() != maxitem-1) {
                    $this.parent().find('.kenburn-thumbs').each(function() {
                        var thumb=$(this);
                        thumb.cssAnimate({
                            'left':(thumb.position().left - opt.thumbWidth)+"px"
                            },{
                            duration:300,
                            queue:false
                        });	
                    });											
                }
										
										
                if (($this.position().left) == 0 && $this.index() > 0) {
                    $this.parent().find('.kenburn-thumbs').each(function() {
                        var thumb=$(this);
                        thumb.cssAnimate({
                            'left':(thumb.position().left + opt.thumbWidth)+"px"
                            },{
                            duration:300,
                            queue:false
                        });	
                    });											
                }
										
										
                if (!$this.hasClass("selected")) {
                    var newslide = top.find('ul li:eq('+$this.data('id')+')');										
                    swapBanner(top.data('currentSlide'),newslide,top,opt);
                }
            });
									
									
								
        });
							
        opt.thumbVertical="bottom";
							
        // POSITION VERTICAL
        if (opt.thumbVertical=="bottom") {
            thc.css({
                'z-index':1000,
                'top':opt.thumbYOffset + (opt.height-opt.thumbHeight)+"px"
                });
        } else {
            if (opt.thumbVertical=="center") {
                thc.css({
                    'z-index':1000,
                    'top':opt.thumbYOffset + (opt.height/2 - opt.thumbHeight/2)+"px"
                    });
            } else {
                thc.css({
                    'z-index':1000,
                    'top':(opt.thumbYOffset)+"px"
                    });
            }
        }
							
        // POSITION HORIZONTAL
        if (opt.thumbHorizontal=="left") {
            thc.css({
                'left':opt.thumbXOffset+"px"
                });
        } else {
            if (opt.thumbHorizontal=="right") {
                thc.css({
                    'left':opt.thumbXOffset + (opt.width - maxwidth)+"px"
                    });
            } else {
                thc.css({
                    'left':opt.thumbXOffset + thc.position().left + "px"
                    });
            }								
        }
							
        if (opt.hideThumbs=="on") {
								
            thc.removeClass('overme');
            opt.overme = 'off';
            var sm = top.find('.slide_mainmask');
								
            setTimeout(function() {
                if (opt.hideThumbs=="on" && !sm.hasClass('overon') && !$('body').hasClass('tp_showthumbsalways')) {
                    thc.animate({
                        'opacity':0
                    },{
                        duration:0,
                        queue:false
                    });
                }
            },10);
        }
							
    }
					
		
    ///////////////////////////
    // CREATE THE BULLETS //
    //////////////////////////
    function createBullets(top,opt) {
						
        var maxitem = top.find('ul >li').length;
						
											
        // CALCULATE THE MAX WIDTH OF THE THUMB HOLDER
        var full = opt.width + opt.padleft + opt.padright;
						
        // Create BULLET CONTAINER

        if (opt.buttonsArrows == "on") {
            top.append('<div class="thumbbuttons"><div class="grainme"><div class="leftarrow"></div><div class="thumbs"></div><div class="rightarrow"></div></div></div>');
            var leftb = top.find('.leftarrow');
            var rightb = top.find('.rightarrow');
                            
                            
            rightb.click(function() 
            { 
                var newitem = top.data('currentSlide');	
                if (newitem.index()<opt.maxitem-1) {
                    var next=top.find('ul li:eq('+(newitem.index()+1)+')');
                } else {
                    var next=top.find('ul li:first');
                }
                swapBanner(newitem,next,top,opt);
            });
            leftb.click(function() 
            {
                var newitem = top.data('currentSlide');	
                if (newitem.index()>0) {
                    var next=top.find('ul li:eq('+(newitem.index()-1)+')');
                } else {
                    var next=top.find('ul li:eq('+(opt.maxitem-1)+')');
                }
                swapBanner(newitem,next,top,opt);
            });
        } else {
            top.append('<div class="thumbbuttons"><div class="grainme"><div class="thumbs"></div></div></div>');
        }
        var minithumbs = top.find('.thumbs');
						
        // GO THROUGHT THE ITEMS, AND CREATE AN THUMBNAIL AS WE NEED
        top.find('ul >li').each(function(i) {
									
            var $this=$(this);
									
						
            var thumb_mini=$('<div class="minithumb" id="minithumb'+i+'"></div>');
									
            thumb_mini.data('id',i);
            minithumbs.append(thumb_mini);
																											
            thumb_mini.click(function() {
                var $this=$(this);
                if (!$this.hasClass("selected")) {
                    var newslide = top.find('ul li:eq('+$this.data('id')+')');										
                    swapBanner(top.data('currentSlide'),newslide,top,opt);
                }
            });
								
        });
							
        minithumbs.waitForImages(function() {
            var tp = parseInt(minithumbs.parent().parent().css('top'),0);
            minithumbs.parent().parent().css({
                'top':(tp+opt.bulletYOffset)+"px",
                'left':((full/2 - parseInt(minithumbs.parent().width(),0)/2)+opt.bulletXOffset)+"px"
                });
								
        });
							
							
							
    }
						
    /////////////////////////////////////////////
    // - START THE ROTATION OF THE BANNER HERE //
    /////////////////////////////////////////////						
    function startRotation(item,opt) {
        if ( $.browser.msie ) {
            item.find('.kenburn-preloader').animate({
                'opacity':'0.0'
            },{
                duration:300,
                queue:false
            });
							
        } else {
            item.find('.kenburn-preloader').cssAnimate({
                'opacity':'0.0'
            },{
                duration:300,
                queue:false
            });
        }
        setTimeout(function() {
            item.find('.kenburn-preloader').remove();
        },300);
        if (opt.lastThumb==undefined) opt.lastThumb=0;
        var first_slide = item.find('ul li:eq('+opt.lastThumb+')') ;
        swapBanner(first_slide,first_slide,item,opt);	
        startParallax(item,opt);
        opt.loaded=1;
						
						
        if (opt.videoWasOn==1)
            item.parent().find('.kenburn-video-button').click();
        opt.videoWasOn=-1;
						
    }
					
					
					
					
    /////////////////////////////////
    // - START THE PARALLAX EFFECT //
    ////////////////////////////////						
    function startParallax(slidertop,opt) {
												
        // FIND THE RIGHT OBJECT 
        var top = slidertop.find('.slide_mainmask');
												
        // SET WIDTH AND HEIGHT
        top.data('maxwidth',opt.width+opt.padleft+opt.padright);
        top.data('maxheight',opt.height+opt.padtop+opt.padbottom);
        top.data('pdistance',opt.parallaxX);
        top.data('pdistancey',opt.parallaxY);
        top.data('cdistance',opt.captionParallaxX);
        top.data('cdistancey',opt.captionParallaxY);
        top.data('opt',opt);
						
						
        // KEN BURN ANIMATION
        var slide = top.parent().data('currentSlide');							
        var par = top.find('.parallax_container');
        var layers = slide.find('.layer_container');
						
						
        // THE FIRST MOUSE OVER ON THE TOP
        top.mouseenter(function(e) {							
            var $this = $(this);			
            // FIND THE RIGHT THUMBNAIL HOLDER OBJECT
            var thma = $this.parent().find('.kenburn_thumb_container #thumbmask');
							
            // IF MOUSE IS NOT OVER THE THUMBS AND START ANIMATION NOT RUNNING															
            var slide = $this.parent().data('currentSlide');							
            var par = slide.find('.parallax_container');
            var layers = slide.find('.layer_container');
								
								
            $this.addClass('overon');						
							
            clearTimeout(opt.hideThumb);
            slidertop.find('.kenburn_thumb_container').animate({
                'opacity':1
            },{
                duration:300,
                queue:false
            });
							
								
        });
						
        // BACK TO CENTER AFTER LEAVE
        top.mouseleave(function(e) {							
            var $this = $(this);																			
            var slide = $this.parent().data('currentSlide');							
            var par = slide.find('.parallax_container');
            var layers = slide.find('.layer_container');
            $this.removeClass("overme");		
            opt.overme = 'off';
            $this.removeClass('overon');
								
            // FIND THE RIGHT THUMBNAIL HOLDER OBJECT							
            var thc = slidertop.find('.kenburn_thumb_container');
								
            setTimeout(function() {
                if (opt.hideThumbs=="on" && !thc.hasClass('overme') && !$('body').hasClass('tp_showthumbsalways')) {																		
                    slidertop.find('.kenburn_thumb_container').animate({
                        'opacity':0
                    },{
                        duration:300,
                        queue:false
                    });
                }
            },10);
								
        });
						
        // HERE COME THE DIRECT PARALLAX HANDLING FOR QUICK ANIMATIONS
        top.mousemove(function(e) {
						
            var $this = $(this);	
            if (opt.pauseOnRollOverMain != "off") {
                $this.addClass("overme");
                opt.overme = 'on';
            }
            // FIND THE RIGHT THUMBNAIL HOLDER OBJECT							
            var thma = $this.parent().find('.kenburn_thumb_container #thumbmask');
            slidertop.find('.kenburn_thumb_container').css({
                'display':'block'
            });
            // IF MOUSE IS NOT OVER THE THUMBS AND START ANIMATION NOT RUNNING
            if (!thma.hasClass('overme') && !$this.hasClass('overon')) {
									
									
                var slide = $this.parent().data('currentSlide');							
                var par = slide.find('.parallax_container');
                var layers = slide.find('.layer_container');																		
									
								
            } else {
								
                setTimeout(function() {
                    $this.removeClass('overon')
                    },100);
            }
        });
						
						
					
    }
						
						
    /////////////////////////////
    // RANDOM ALIGN GENERATOR //
    ////////////////////////////
    function randomAlign() {
						
        var align="";
        var a=Math.floor(Math.random()*3);
        var b=Math.floor(Math.random()*3);
						
        if (a==0) align="left"; 
        else
        if (a==1) align="center" 
        else
            align="right";
						
        if (b==0) align=align+",top" 
        else
        if (b==1) align=align+",center" 
        else
            align=align+",bottom";
        return align;
    }
										
    ////////////////////////////////////////////////////
    // - THE BANNER SWAPPER, ONE AGAINST THE OTHER :) //
    ////////////////////////////////////////////////////
    function swapBanner(item,newitem,slider_container,opt) {
									
        clearInterval(opt.aktKenInterval);
        var trans=false;
        //console.log("SWAPBANNER Called");
        slider_container.find('ul >li').each(function(i) {
            var $this=$(this);
            clearInterval($this.data('interval'));
								
            if ($this.index() !=item.index() && $this.index() !=newitem.index()) {
                $this.css({
                    'display':'none',
                    'position':'absolute',
                    'left':'0px',
                    'z-index':'994'
                });									
									
            }
        });
							
									
        var video = slider_container.find('.slide_mainmask .video_kenburn');														
        setTimeout(function() {
            video.remove()
            },600);
							
        var slidemask = slider_container.find('.slide_mainmask');
        slidemask.removeClass("videoon");
							
        item.css({
            'position':'absolute',
            'top':'0px',
            'left':'0px',
            'z-index':'900'
        });
        newitem.css({
            'position':'absolute',
            'top':'0px',
            'left':'0px',
            'z-index':'1000'
        });
        newitem.css({
            'display':'block'
        });
        //Lets find the Image 
        var sour=newitem.find('img:first');
        var sourbw=newitem.find('.bw-main-image');
							
							
        var kenburn=true;
        if (newitem.data('kenburn')=="off" || (navigator.userAgent.match(/Android/i)) )
        {
            hasCanvas=false;
            kenburn=false;
            newitem.data('startalign','center,center');
            newitem.data('endalign','center,center');
            newitem.data('zoom','none');
            newitem.data('zoomfact', 0);
        }
							
        // Lets Save the Size of the IMG first in the DATA
        if (newitem.data('ww') == undefined) {
            var oldW=newitem.find('img').width()			//Read out the Width					
            var oldH=newitem.find('img').height()			//Read out the Height					
            if (oldW!=0) {									// If the Width is not 0 (the image is loaded)
									
                // Let See if the KenBurn Img is smaller than the stage (width). If yes, we need to scale it first ! 
                if (sour.width()>0 && sour.width()<opt.width) {														
                    var factor=opt.width / oldW;														
                    oldW=oldW*factor;
                    oldH=oldH*factor;														
										
                }
																
                // Let See if the KenBurn IMG is smaller then the stage height). If yes, we need to scale it first !!
                if (sour.height()>0 && sour.height()<opt.height) {														
                    var factor=opt.height / oldH;														
                    oldW=oldW*factor;
                    oldH=oldH*factor;																								
                }
									
                newitem.data('ww',oldW);
                newitem.data('hh',oldH);
            }
        } else {
								
            var oldW = newitem.data('ww');
            var oldH = newitem.data('hh');
        }

        oldW = Math.floor( oldW*(opt._propw) );
        oldH = Math.floor( oldH*(opt._proph) );

        // Create the Standard Values
        var newT=0;
        var newL=0;
        var endT=0;
        var endL=0;
        if (kenburn) {			
            var startalign = newitem.data('startalign');
            var endalign = newitem.data('endalign');
            if (startalign=="random") startalign = randomAlign();							
            if (endalign=="random") endalign = randomAlign();							
											
            // Lets Compute the Start Position here depending on the Start Align
            if (startalign != undefined) {	
												
                var salignh = startalign;								
                var horiz = salignh.split(',')[0];
                var vert = salignh.split(',')[1];
											
												
                if (horiz == "left") newL=0;
                else 
                if (horiz == "center") newL=(opt.width/2 - oldW/2);
                else
                if (horiz == "right") newL= 0 - Math.abs(opt.width - oldW);	
												
                if (vert == "top") newT=0;
                else 
                if (vert == "center") newT=(opt.height/2 - oldH/2);
                else
                if (vert == "bottom") newT= 0 - Math.abs(opt.height - oldH);										 
            }
											
											
            // Lets compute the End Positions depending on the End Align
            if (endalign != undefined) {		
												
                var ealignh = endalign;								
                var horiz = ealignh.split(',')[0];
                var vert = ealignh.split(',')[1];
												
                if (horiz == "left") endL=0;
                else 
                if (horiz == "center") endL=(opt.width/2 - oldW/2);
                else
                if (horiz == "right") endL= 0 - Math.abs(opt.width - oldW);	
												
                if (vert == "top") endT=0;
                else 
                if (vert == "center") endT=(opt.height/2 - oldH/2);
                else
                if (vert == "bottom") endT= 0 - Math.abs(opt.height - oldH);										 
            }
											
											
        } 
								
        // Remove the Interval of the old item. So it do not disturb the CPU any more
        clearInterval(item.data('interval'));
												
        sour.parent().find('.canvas-now').remove();
        sour.parent().find('.canvas-now-bw').remove();
								
        // CHECK THE CANVAS SUPPORT HERE
        if (kenburn) {
            var hasCanvas=isCanvasSupported();
            var isIEunder9 = $.browser.msie && $.browser.version < 9;																		
            if (isIEunder9) hasCanvas=false;						
        }
        var hascaption = true;
        // CAPTION POSITION AND SIZING
        if (newitem.find('.creative_layer div').length>0) {
			var creative_layer_div = newitem.find('.creative_layer div');
            var clw = creative_layer_div.outerWidth();
            var clh = creative_layer_div.outerHeight();
            var clt = creative_layer_div.position().top;
            var cll = creative_layer_div.position().left;
        } else {
            hascaption=false;
            var clw=0;
            var clh=0;
            var clt=0;
            var cll=0;
            sourbw.remove();
        }
								
								
        // IF THERE IS CANVAS AVAILABLE, WE CAN CREATE A CANVAS HERE....
        if (hasCanvas) {
									
            sour.parent().append('<div style="position:absolute;z-index:1" class="canvas-now"><canvas class="canvas-now-canvas" width="'+oldW+'" height="'+oldH+'"></canvas></div>');
            sour.css({
                'display':'none'
            });
            var canvas=sour.parent().find('.canvas-now-canvas')[0];
            var context = canvas.getContext('2d');
									
            if (sourbw.length>0) {
                sour.parent().append('<div style="position:absolute;z-index:20" class="canvas-now-bw"><canvas class="canvas-now-canvas-bw" width="'+oldW+'" height="'+oldH+'"></canvas></div>');
                sourbw.css({
                    'display':'none'
                });
                var canvasbw=sour.parent().find('.canvas-now-canvas-bw')[0];
										
                if (opt.blurwrap == 'on') {
                    sour.parent().find('.canvas-now-bw').wrap('<div class="blurwrap" style="width:'+clw+'px;height:'+clh+'px;position:absolute;top:'+clt+'px;left:'+cll+'px;overflow:hidden"></div>');
                }
                var contextbw = canvasbw.getContext('2d');
            }
        } else {

            if (sourbw.parent().hasClass("blurwrap")) {
            } else {
                if (opt.blurwrap == 'on') {
                    sourbw.wrap('<div class="blurwrap" style="width:'+clw+'px;height:'+clh+'px;position:absolute;top:'+clt+'px;left:'+cll+'px;overflow:hidden;"></div>');								
                }
            }
									
        }
															
        sour.css({
            '-webkit-transform':'translateZ(0)'
        });
        sourbw.css({
            '-webkit-transform':'translateZ(0)'
        });
								
        // LETS GET THE TIME 
        var time=newitem.data('panduration');
								
        // DEFAULT VALUES FOR SCALING AND MOVING THE IMAGE
        var scalerX=0;
        var scalerY=0;

        var newW=oldW;
        var newH=oldH;
								
        // READ OUT THE ZOOMFACTOR
        var zoomfact=newitem.data('zoomfact')
        var zoom = newitem.data('zoom');
								
        if (zoom=="random") {
            if (Math.floor(Math.random()*2) == 0) zoom="out" 
            else 
                zoom="in";
        }
								
        if (newitem.data('zoomfact')=="random") {
            zoomfact=(Math.random()*1 + 1);
        }
								
								
        // IF WE ZOOM OUT, WE NEED TO RESET THE ZOOM FIRST TO "BIG"
        if (zoom == "out") {						
            newW=newW*zoomfact;
            newH=newH*zoomfact;
            newL=newL*zoomfact;
            newT=newT*zoomfact;
        }
								
        // NOW LETS CALCULATE THE STEPS HERE
        var movX = (endL-newL) / (time*25);
        var movY = (endT-newT) / (time*25);
								
								
								
        var opaStep = 1/(time*25);
        // STANDARD ZOOM STEPS
        scalerX=(oldW*zoomfact) / (time*25)/10;
        scalerY=(oldH*zoomfact) / (time*25)/10;															
								
        // IF ZOOM OUT, WE INVERT THE ZOOM STEPS
        if (zoom == "out") {							
            scalerX=scalerX*-1;
            scalerY=scalerY*-1;
        } 
								
								
								
        // Lets compute the End Zoom Offsets depending on the End Align
        if (newitem.data('endalign') != undefined) {																
            var ealignh = newitem.data('endalign');								
            var horiz = ealignh.split(',')[0];
            var vert = ealignh.split(',')[1];
									
            if (horiz == "left") movX = movX + scalerX/4;
            else 
            if (horiz == "center") movX = movX - scalerX/2;
            else
            if (horiz == "right") movX = movX - scalerX;	
									
            if (vert == "top") movY = movY + scalerY/4;
            else 
            if (vert == "center") movY = movY - scalerY/2;
            else
            if (vert == "bottom") movY = movY - scalerY;
        }
								
								
								
								
								
        // IF THE TIMER IS SMALLER THAN THE BASIC TIMER, THAN THE MAIN TIMER NEED TO BE REDUCED TO 
        if (opt.timer>parseInt(newitem.data('panduration'),0)*10) {
            opt.timer=parseInt(newitem.data('panduration'),0)*10 
        } else {
            opt.timer=opt.savedTimer*10;
									
        }
								
								
        sour.parent().find('.canvas-now-bw').css({
            'opacity':0
        });
								
        if (hasCanvas) {
									
            //context.css({'-webkit-transform':'translateZ(0)'});
            //contextbw.css({'-webkit-transform':'translateZ(0)'});
            context.drawImage(sour[0],newL,newT,newW,newH);
            if (sourbw.length>0 && hascaption) {		
                contextbw.drawImage(sourbw[0],newL,newT,newW,newH);
                setTimeout(function() {
                    sour.parent().find('.canvas-now-bw').cssAnimate({
                        'opacity':'1.0'
                    },{
                        duration:1000,
                        queue:false
                    });
                },1200);
											
            }
        }  
								
        sour.cssStop(true,true);
        sourbw.cssStop(true,true);
								
        if (kenburn) {
            sour.css({
                'position':'absolute',
                'left':newL+"px",
                'top':newT+"px",
                'width':newW+"px",
                'height':newH+"px",
                'opacity':1.0
            });
											
            sourbw.css({
                'position':'absolute',
                'left':newL+"px",
                'top':newT+"px",
                'width':newW+"px",
                'height':newH+"px",
                'opacity':1.0
            });
								
            var oldL = newL;
            var oldT = newT;
            var oldWW = newW;
            step=0;
        } else {
											
            var wFF = opt.width /newW;
            var hFF = opt.height / newH;
											
            if (wFF>hFF) {
                newW=opt.width;
                newH = newH * wFF;
            } else {
                newW = newW * hFF;
                newH = opt.height;
            }
											
											
            sour.css({
                'position':'absolute',
                'left':newL+"px",
                'top':newT+"px",
                'width':newW+"px",
                'height':newH+"px",
                'opacity':1.0
            });
											
            sourbw.css({
                'position':'absolute',
                'left':(newL-cll)+"px",
                'top':(newT-clt)+"px",
                'width':newW+"px",
                'height':newH+"px",
                'opacity':0.0
            });
											
            setTimeout(function() {
                sourbw.animate({
                    'opacity':'1.0'
                },{
                    duration:1000,
                    queue:false
                });
            },1200);
        //sourbw.remove();
        }							
												
							
							
        //console.log('SWAPBANNER : READY FOR KEN BURN');
        // NOW WE CAN CREATE AN INTERVAL, WHICH WILL SHOW 25 FRAMES PER SEC (TO MINIMIZE THE CPU STEPS)
        if (kenburn) {
            opt.overme = 'off';
            opt.aktKenInterval = setInterval(function() {				
                //$('body').find('.testinfo').html(opt.aktKenInterval+"  "+Math.floor(Math.random()*10000));
                // accelerating
                //if (!slider_container.parent().parent().find('.kenburn_thumb_container #thumbmask').hasClass('overme') && !slider_container.find('.slide_mainmask').hasClass('overme') && !slider_container.find('.slide_mainmask').hasClass('videoon')) {
                
                if (opt.overme != 'on') {
												
                    newW=newW+scalerX;		//CHANGE THE SCALING PARAMETES
                    newH=newH+scalerY;									
                    					
                    newL=newL+movX;			// MOVE THE POSITION OF THE IMAGES 
                    newT=newT+movY;
												
                    if (newL>0) newL=0;
                    if (newT>0) newT=0;
                    if (newL<(opt.width - newW)) newL=opt.width-newW;
                    if (newT<(opt.height - newH)) newT=opt.height-newH;
					
                    if (hasCanvas) {																			
                        context.drawImage(sour[0],newL,newT,newW,newH);
                        if (sourbw.length>0) contextbw.drawImage(sourbw[0],(newL-cll),(newT-clt),newW,newH);										
                    } else {
							
                        var s=newW/oldWW;
                        var p1=newL - oldL;
                        var p2=newT - oldT;
                        //var p3=newL - oldL - cll;
                        //var p4=newT - oldT - clt;
                        
                        if( jQuery.browser.msie ) {
															
                            sour.css({
                                'filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p1 + ',Dy=' + p2 + ')'
                                })
                                .css({
                                '-ms-filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p1 + ',Dy=' + p2 + ')'
                                });
								   
                            // sourbw.css({'filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p3 + ',Dy=' + p4 + ')'});
                            // sourbw.css({'-ms-filter': 'progid:DXImageTransform.Microsoft.Matrix(FilterType="bilinear",M11=' + s + ',M12=0,M21=0,M22=' + s + ',Dx=' + p3 + ',Dy=' + p4 + ')'});
																   
																   
                            sourbw.remove();
																
                        } else {
												
                            sour.cssAnimate({
                                'left':newL+"px",
                                'top':newT+"px",
                                'width':newW+"px",
                                'height':newH+"px"
                                },
                                {
                                duration:38, 
                                easing:'linear',
                                queue:false
                            });
																	
                            if (sourbw.length>0) {				
                                sourbw.cssAnimate({
                                    'left':newL+"px",
                                    'top':newT+"px",
                                    'width':newW+"px",
                                    'height':newH+"px"
                                    },
                                    {
                                    duration:38, 
                                    easing:'linear',
                                    queue:false
                                });														
																		
                            }
                        }
													
                    }
                }
            },40);
        }																																
							
							
        var is_chrome = /chrome/.test( navigator.userAgent.toLowerCase() );							
							
        if(is_chrome && opt.repairChromeBug=="on") {
            newitem.data('transition','slide');
        }
							
        //console.log("SWAPBANNER : SLIDE/FADE OLD AND NEW SLIDES");
							
        if (item.index()!=newitem.index()) {
            setTimeout(function() {
                //item.find('.canvas-now').css({'visibility':'hidden'});
                item.find('.canvas-now-bw').css({
                    'visibility':'hidden'
                });
            },0);
        }
							
							
        // TRANSITION OF THE SLIDES
        if (newitem.data('transition')=="slide") {
            if (trans==false) {
                var left=true;																				
                if (item.index()>newitem.index()) left = false;
												
                if (left) {		
													
                    video.animate({
                        'left':(0-opt.width)+'px'
                        },{
                        duration:600,
                        queue:false
                    });																												
                    newitem.find('.slide_container').stop(true,true);
                    newitem.find('.slide_container').css({
                        'opacity':'1.0',
                        'left':opt.width+"px"
                        });
													
                    item.find('.slide_container').animate({
                        'left':0-opt.width+'px'
                        },{
                        duration:600,
                        queue:false
                    });
                    newitem.find('.slide_container').animate({
                        'left':'0px',
                        'top':'0px',
                        'opacity':'1.0'
                    },{
                        duration:600,
                        queue:false
                    });
													
													
														
													
                } else {
												
                    video.animate({
                        'left':(opt.width)+'px'
                        },{
                        duration:600,
                        queue:false
                    });
                    newitem.find('.slide_container').stop(true,true);
                    newitem.find('.slide_container').css({
                        'opacity':'1.0',
                        'position':'absolute',
                        'top':'0px',
                        'left':0-opt.width+'px'
                        });	
													
                    //if ( $.browser.msie )  {
                    item.find('.slide_container').animate({
                        'left':opt.width+'px'
                        },{
                        duration:600,
                        queue:false
                    });											
                    newitem.find('.slide_container').animate({
                        'left':'0px',
                        'top':'0px',
                        'opacity':'1.0'
                    },{
                        duration:600,
                        queue:false
                    });
                //} else {
                //item.find('.slide_container').cssAnimate({'left':opt.width+'px'},{duration:600,queue:false});											
                //newitem.find('.slide_container').cssAnimate({'left':'0px','top':'0px','opacity':'1.0'},{duration:600,queue:false});
                //}
													
													
													
													
                }
            }
        } else {																								
            //if ( $.browser.msie ) 
            item.find('.slide_container').stop(true,true);
            item.find('.slide_container').animate({
                'opacity':'0'
            },{
                duration:600,
                queue:false
            });	
            //else
            //item.find('.slide_container').cssAnimate({'opacity':'0'},{duration:600,queue:false});	
								
            video.animate({
                'opacity':'0.0'
            },{
                duration:600,
                queue:false
            });		
								
								
            //if ( $.browser.msie ) 
            newitem.find('.slide_container').stop(true,true);
            newitem.find('.slide_container').css({
                'opacity':'0.0',
                'left':'0px',
                'top':'0px'
            });								
            newitem.find('.slide_container').animate({
                'opacity':'1.0'
            },{
                duration:600,
                queue:false
            });
        //else
        //newitem.find('.slide_container').cssAnimate({'opacity':'1.0'},{duration:600,queue:false});
        }
							
							
						
						
        // SET THE THUMBNAIL
        //console.log("SWAPBANNER : THUMBNAIL MANAGEMENT");
						
        if (slider_container.find('.kenburn_thumb_container').length>0) {
            var thumb = slider_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+newitem.index());
							
            slider_container.find('.kenburn_thumb_container #thumbmask .thumbsslide #thumb'+item.index()).each(function(i) {						
                var $this=$(this);								
                if ($this.attr('id')!="thumb"+newitem.index()) {
											
                    $this.removeClass('selected');																
                    $this.stop();
                    $this.find('.overlay').animate({
                        'opacity':0.75
                    },{
                        duration:300,
                        queue:false
                    });											
                } 
            });
								
            thumb.addClass('selected');
            thumb.find('.overlay').animate({
                'opacity':0
            },{
                duration:300,
                queue:false
            });								
            slider_container.data('currentThumb',thumb);
            opt.currentThumb=thumb.index();
									
								
            if ((thumb.position().left+opt.thumbWidth) == opt.thumbmaxwidth && thumb.index() != opt.maxitem-1) {
								
                thumb.parent().find('.kenburn-thumbs').each(function() {
                    var thumbs=$(this);
                    thumbs.cssAnimate({
                        'left':(thumbs.position().left - opt.thumbWidth)+"px"
                        },{
                        duration:300,
                        queue:false
                    });	
                });											
            }
											
											
            if ((thumb.position().left) == 0 && thumb.index() > 0) {
                thumb.parent().find('.kenburn-thumbs').each(function() {
                    var thumbs=$(this);
                    thumbs.cssAnimate({
                        'left':(thumbs.position().left + opt.thumbWidth)+"px"
                        },{
                        duration:300,
                        queue:false
                    });	
                });											
            }
								
            if (thumb.index()==0) {
                thumb.parent().find('.kenburn-thumbs').each(function() {
                    var thumbs=$(this);
                    thumbs.cssAnimate({
                        'left':0 + (thumbs.index()*opt.thumbWidth)+"px"
                        },{
                        duration:300,
                        queue:false
                    });	
                });											
            }
        } 
						
        //console.log("SWAPBANNER : THUMBNAIL MANAGEMENT ENDS");
							
        if (slider_container.find('.minithumb').length>0) {
            var thumb = slider_container.find('#minithumb'+newitem.index());
            //console.log('SWAPBANNER : CHANGE SELECTED THUMBS');
            slider_container.find('.minithumb').removeClass('selected');
            //console.log('SWAPBANNER : MINITHUMB CLASS SELECTED REMOVED');
            thumb.addClass('selected');
            //console.log('SWAPBANNER : thumb:'+thumb);
            if (opt.thumbStyle!="both") slider_container.data('currentThumb',thumb);
            //console.log('SWAPBANNER : THUMB CLASSIFIZING ENDS');					
							
            opt.currentThumb=thumb.index();
							
        }
						
						
        //SAVE THE LAST SLIDE
        slider_container.data('currentSlide',newitem);								
						
        //console.log('SWAPBANNER : currentSlide Seted');
						
        // START 
        textanim(newitem,100,slider_container);
        opt.cd=0;
						
    //console.log("SWAPBANNER : SWAPBANNER ENDS");
																
    }
					
				
				
    //////////////////////////////////////////
    // CHECK IF CANCAS (HTML5) IS SUPPORTED //
    //////////////////////////////////////////
    function isCanvasSupported(){
        var elem = document.createElement('canvas');
        return !!(elem.getContext && elem.getContext('2d'));
    }
				
				
    ////////////////////////////////////
    // AUTOMATIC COUNTDOWN FOR SLIDER //
    ////////////////////////////////////
    function startTimer(top,opt) {
        opt.cd=0;
					
        if ( $.browser.msie ) 									
            top.find('.kenburn_thumb_container #thumbmask .thumbsslide').cssAnimate({
                'left':'0px'
            },{
                duration:300,
                queue:false
            });
        else
            top.find('.kenburn_thumb_container #thumbmask .thumbsslide').animate({
                'left':'0px'
            },{
                duration:300,
                queue:false
            });
        var tmask = top.find('.kenburn_thumb_container #thumbmask');
        var tslide = tmask.find('.thumbsslide');
					
        var slidemask = top.find('.slide_mainmask');
					
					
								
        var slidemask = top.find('.slide_mainmask');
								
        opt.timerinterval = setInterval(function() {
            if (opt.loaded==1) {
                var newitem = top.data('currentSlide');							
                var thumb = top.data('currentThumb');
												
                if (!slidemask.hasClass('overme') && !slidemask.hasClass('videoon')) {
																
                    opt.cd=opt.cd+1;
                    if (opt.cd==opt.timer) {
                        //console.log("NEXT");
                        opt.cd=0;
                        if (newitem !=undefined) {
                            //console.log("NEWITEM EXIST");
                            if (newitem.index()<opt.maxitem-1) {
                                //console.log("NEWITEM INDEX:"+newitem.index());
                                var next=top.find('ul li:eq('+(newitem.index()+1)+')');
                                //console.log("NEXT ITEM INDEX:"+next.index());
                                swapBanner(newitem,next,top,opt);
                                //console.log("NEXT BANNER CALLED")
                                if (opt.thumbStyle!="none") {
                                    var minus = 0-parseInt(thumb.parent().css('left'),0);
                                    if (tslide!=null && tslide!=undefined) {
                                        tslide.css({
                                            'position':'absolute'
                                        });
                                        if (Math.abs(minus)<=top.data('thumbnailmaxdif')) {							
                                            if ( $.browser.msie ) 											
                                                tslide.animate({
                                                    'left':minus+'px'
                                                    },{
                                                    duration:300,
                                                    queue:false
                                                });
                                            else
                                                tslide.cssAnimate({
                                                    'left':minus+'px'
                                                    },{
                                                    duration:300,
                                                    queue:false
                                                });
                                        } else {
                                            minus = 0-top.data('thumbnailmaxdif');							
                                            if ( $.browser.msie ) 																					
                                                tslide.animate({
                                                    'left':minus+'px'
                                                    },{
                                                    duration:300,
                                                    queue:false
                                                });
                                            else
                                                tslide.cssAnimate({
                                                    'left':minus+'px'
                                                    },{
                                                    duration:300,
                                                    queue:false
                                                });
                                        }
                                    }
                                //console.log("NEXT-ENDE");
                                }
																				
                            } else {
                                swapBanner(newitem,top.find('ul li:first'),top,opt);	
                                if (tslide!=null && tslide!=undefined) {
                                    if ( $.browser.msie ) 																					
                                        tslide.animate({
                                            'left':'0px'
                                        },{
                                            duration:300,
                                            queue:false
                                        });
                                    else
                                        tslide.cssAnimate({
                                            'left':'0px'
                                        },{
                                            duration:300,
                                            queue:false
                                        });
                                }
																				
                            }
                        }
                    }
                }
            }			
        },100);
																
								
							
    }
				
							
				
				
    ///////////////////
    // TEXTANIMATION //
    //////////////////			
    function textanim (item,edelay,slider_container) {
												
        var counter=2;
				
        item.find('.creative_layer div').each(function(i) {
			
            var $this=$(this);
												
            // REMEMBER OLD VALUES
            if ($this.data('_top') == undefined) $this.data('_top',$this.position().top);
            if ($this.data('_left') == undefined) $this.data('_left',$this.position().left);
            if ($this.data('_op') == undefined) {
                $this.data('_op',$this.css('opacity'));
            }
								
            // CHANGE THE z-INDEX HERE
            $this.css({
                'z-index':1200,
                'visibility':'visible'
            });
													
            //console.log('TEXTANIM : ANIMATION FADE UP CHECK');
            //console.log('TEXTANIM : '+$this.data('_left'));
            //// -  FADE UP   -   ////
            if ($this.hasClass('fadeup')) {
                $this.animate({
                    'top':$this.data('_top')+20+"px",
                    'opacity':0
                },
                {
                    duration:0,
                    queue:false
                })
                .delay(edelay + (counter+1)*350)
                .animate({
                    'top':$this.data('_top')+"px",
                    'opacity':$this.data('_op')
                    },
                    {
                    duration:500,
                    queue:true
                })
                counter++;
            } else if ($this.hasClass('faderight')) {
                //// -  FADE RIGHT   -   ////
                $this.animate({
                    'left':$this.data('_left')-20+"px",
                    'opacity':0
                },
                {
                    duration:0,
                    queue:false
                })
                .delay(edelay + (counter+1)*350)
                .animate({
                    'left':$this.data('_left')+"px",
                    'opacity':$this.data('_op')
                    },
                    {
                    duration:500,
                    queue:true
                })
                counter++;
            } else if ($this.hasClass('fadedown')) {
                //// -  FADE DOWN  -   ////
                $this.animate({
                    'top':$this.data('_top')-20+"px",
                    'opacity':0
                },
                {
                    duration:0,
                    queue:false
                })
                .delay(edelay + (counter+1)*350)
                .animate({
                    'top':$this.data('_top')+"px",
                    'opacity':$this.data('_op')
                    },
                    {
                    duration:500,
                    queue:true
                })
                counter++;
            } else if ($this.hasClass('fadeleft')) {
                //// -  FADE LEFT   -   ////
                $this.animate({
                    'left':$this.data('_left')+20+"px",
                    'opacity':0
                },
                {
                    duration:0,
                    queue:false
                })
                .delay(edelay + (counter+1)*350)
                .animate({
                    'left':$this.data('_left')+"px",
                    'opacity':$this.data('_op')
                    },
                    {
                    duration:500,
                    queue:true
                })
                counter++;
            } else if ($this.hasClass('fade')) {
                //// -  FADE   -   ////
                $this.animate({
                    'opacity':0
                },
                {
                    duration:0,
                    queue:false
                })
                .delay(edelay + (counter+1)*350)
                .animate({
                    'opacity':$this.data('_op')
                    },
                    {
                    duration:500,
                    queue:true
                })
                counter++;
            }
																	
																																		
																	
															
        });	// END OF TEXT ANIMS ON DIVS
					
    }
})(jQuery);			

// kb-plugin
// must be placed after main kb code
(function(a,b){

	// EASINGS
	jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(a,b,c,d,e){return jQuery.easing[jQuery.easing.def](a,b,c,d,e)},easeInQuad:function(a,b,c,d,e){return d*(b/=e)*b+c},easeOutQuad:function(a,b,c,d,e){return-d*(b/=e)*(b-2)+c},easeInOutQuad:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b+c;return-d/2*(--b*(b-2)-1)+c},easeInCubic:function(a,b,c,d,e){return d*(b/=e)*b*b+c},easeOutCubic:function(a,b,c,d,e){return d*((b=b/e-1)*b*b+1)+c},easeInOutCubic:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b+c;return d/2*((b-=2)*b*b+2)+c},easeInQuart:function(a,b,c,d,e){return d*(b/=e)*b*b*b+c},easeOutQuart:function(a,b,c,d,e){return-d*((b=b/e-1)*b*b*b-1)+c},easeInOutQuart:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b+c;return-d/2*((b-=2)*b*b*b-2)+c},easeInQuint:function(a,b,c,d,e){return d*(b/=e)*b*b*b*b+c},easeOutQuint:function(a,b,c,d,e){return d*((b=b/e-1)*b*b*b*b+1)+c},easeInOutQuint:function(a,b,c,d,e){if((b/=e/2)<1)return d/2*b*b*b*b*b+c;return d/2*((b-=2)*b*b*b*b+2)+c},easeInSine:function(a,b,c,d,e){return-d*Math.cos(b/e*(Math.PI/2))+d+c},easeOutSine:function(a,b,c,d,e){return d*Math.sin(b/e*(Math.PI/2))+c},easeInOutSine:function(a,b,c,d,e){return-d/2*(Math.cos(Math.PI*b/e)-1)+c},easeInExpo:function(a,b,c,d,e){return b==0?c:d*Math.pow(2,10*(b/e-1))+c},easeOutExpo:function(a,b,c,d,e){return b==e?c+d:d*(-Math.pow(2,-10*b/e)+1)+c},easeInOutExpo:function(a,b,c,d,e){if(b==0)return c;if(b==e)return c+d;if((b/=e/2)<1)return d/2*Math.pow(2,10*(b-1))+c;return d/2*(-Math.pow(2,-10*--b)+2)+c},easeInCirc:function(a,b,c,d,e){return-d*(Math.sqrt(1-(b/=e)*b)-1)+c},easeOutCirc:function(a,b,c,d,e){return d*Math.sqrt(1-(b=b/e-1)*b)+c},easeInOutCirc:function(a,b,c,d,e){if((b/=e/2)<1)return-d/2*(Math.sqrt(1-b*b)-1)+c;return d/2*(Math.sqrt(1-(b-=2)*b)+1)+c},easeInElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return-(h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g))+c},easeOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e)==1)return c+d;if(!g)g=e*.3;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);return h*Math.pow(2,-10*b)*Math.sin((b*e-f)*2*Math.PI/g)+d+c},easeInOutElastic:function(a,b,c,d,e){var f=1.70158;var g=0;var h=d;if(b==0)return c;if((b/=e/2)==2)return c+d;if(!g)g=e*.3*1.5;if(h<Math.abs(d)){h=d;var f=g/4}else var f=g/(2*Math.PI)*Math.asin(d/h);if(b<1)return-.5*h*Math.pow(2,10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)+c;return h*Math.pow(2,-10*(b-=1))*Math.sin((b*e-f)*2*Math.PI/g)*.5+d+c},easeInBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*(b/=e)*b*((f+1)*b-f)+c},easeOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;return d*((b=b/e-1)*b*((f+1)*b+f)+1)+c},easeInOutBack:function(a,b,c,d,e,f){if(f==undefined)f=1.70158;if((b/=e/2)<1)return d/2*b*b*(((f*=1.525)+1)*b-f)+c;return d/2*((b-=2)*b*(((f*=1.525)+1)*b+f)+2)+c},easeInBounce:function(a,b,c,d,e){return d-jQuery.easing.easeOutBounce(a,e-b,0,d,e)+c},easeOutBounce:function(a,b,c,d,e){if((b/=e)<1/2.75){return d*7.5625*b*b+c}else if(b<2/2.75){return d*(7.5625*(b-=1.5/2.75)*b+.75)+c}else if(b<2.5/2.75){return d*(7.5625*(b-=2.25/2.75)*b+.9375)+c}else{return d*(7.5625*(b-=2.625/2.75)*b+.984375)+c}},easeInOutBounce:function(a,b,c,d,e){if(b<e/2)return jQuery.easing.easeInBounce(a,b*2,0,d,e)*.5+c;return jQuery.easing.easeOutBounce(a,b*2-e,0,d,e)*.5+d*.5+c}})		
	
	
	// WAIT FOR IMAGES
	/*
	* waitForImages 1.4
	* -----------------
	* Provides a callback when all images have loaded in your given selector.
	* http://www.alexanderdickson.com/
	*
	*
	* Copyright (c) 2011 Alex Dickson
	* Licensed under the MIT licenses.
	* See website for more info.
	*
	*/
	a.waitForImages={hasImageProperties:["backgroundImage","listStyleImage","borderImage","borderCornerImage"]};a.expr[":"].uncached=function(b){var c=document.createElement("img");c.src=b.src;return a(b).is('img[src!=""]')&&!c.complete};a.fn.waitForImages=function(b,c,d){if(a.isPlainObject(arguments[0])){c=b.each;d=b.waitForAll;b=b.finished}b=b||a.noop;c=c||a.noop;d=!!d;if(!a.isFunction(b)||!a.isFunction(c)){throw new TypeError("An invalid callback was supplied.")}return this.each(function(){var e=a(this),f=[];if(d){var g=a.waitForImages.hasImageProperties||[],h=/url\((['"]?)(.*?)\1\)/g;e.find("*").each(function(){var b=a(this);if(b.is("img:uncached")){f.push({src:b.attr("src"),element:b[0]})}a.each(g,function(a,c){var d=b.css(c);if(!d){return true}var e;while(e=h.exec(d)){f.push({src:e[2],element:b[0]})}})})}else{e.find("img:uncached").each(function(){f.push({src:this.src,element:this})})}var i=f.length,j=0;if(i==0){b.call(e[0])}a.each(f,function(d,f){var g=new Image;a(g).bind("load error",function(a){j++;c.call(f.element,j,i,a.type=="load");if(j==i){b.call(e[0]);return false}});g.src=f.src})})}
	
	
	// CSS ANIMATE
	/**************************************\
	 *  cssAnimate 1.1.5 for jQuery       *
	 *  (c) 2012 - Clemens Damke          *
	 *  Licensed under MIT License        *
	 *  Works with jQuery >=1.4.3         *
	/**************************************/
	var b = ["Webkit", "Moz", "O", "Ms", "Khtml", ""];
	var c = ["borderRadius", "boxShadow", "userSelect", "transformOrigin", "transformStyle", "transition", "transitionDuration", "transitionProperty", "transitionTimingFunction", "backgroundOrigin", "backgroundSize", "animation", "filter", "zoom", "columns", "perspective", "perspectiveOrigin", "appearance"];
	a.fn.cssSetQueue = function (b, c) {
		v = this;
		var d = v.data("cssQueue") ? v.data("cssQueue") : [];
		var e = v.data("cssCall") ? v.data("cssCall") : [];
		var f = 0;
		var g = {};
		a.each(c, function (a, b) {
			g[a] = b
		});
		while (1) {
			if (!e[f]) {
				e[f] = g.complete;
				break
			}
			f++
		}
		g.complete = f;
		d.push([b, g]);
		v.data({
			cssQueue : d,
			cssRunning : true,
			cssCall : e
		})
	};
	a.fn.cssRunQueue = function () {
		v = this;
		var a = v.data("cssQueue") ? v.data("cssQueue") : [];
		if (a[0])
			v.cssEngine(a[0][0], a[0][1]);
		else
			v.data("cssRunning", false);
		a.shift();
		v.data("cssQueue", a)
	};
	a.cssMerge = function (b, c, d) {
		a.each(c, function (c, e) {
			a.each(d, function (a, d) {
				b[d + c] = e
			})
		});
		return b
	};
	a.fn.cssAnimationData = function (a, b) {
		var c = this;
		var d = c.data("cssAnimations");
		if (!d)
			d = {};
		if (!d[a])
			d[a] = [];
		d[a].push(b);
		c.data("cssAnimations", d);
		return d[a]
	};
	a.fn.cssAnimationRemove = function () {
		var b = this;
		if (b.data("cssAnimations") != undefined) {
			var c = b.data("cssAnimations");
			var d = b.data("identity");
			a.each(c, function (a, b) {
				c[a] = b.splice(d + 1, 1)
			});
			b.data("cssAnimations", c)
		}
	};
	a.css3D = function (c) {
		a("body").data("cssPerspective", isFinite(c) ? c : c ? 1e3 : 0).cssOriginal(a.cssMerge({}, {
				TransformStyle : c ? "preserve-3d" : "flat"
			}, b))
	};
	a.cssPropertySupporter = function (d) {
		a.each(c, function (c, e) {
			if (d[e])
				a.each(b, function (a, b) {
					var c = e.substr(0, 1);
					d[b + c[b ? "toUpperCase" : "toLowerCase"]() + e.substr(1)] = d[e]
				})
		});
		return d
	};
	a.cssAnimateSupport = function () {
		var c = false;
		a.each(b, function (a, b) {
			c = document.body.style[b + "AnimationName"] !== undefined ? true : c
		});
		return c
	};
	a.fn.cssEngine = function (c, d) {
		function e(a) {
			return String(a).replace(/([A-Z])/g, "-$1").toLowerCase()
		}
		var f = this;
		var f = this;
		if (typeof d.complete == "number")
			f.data("cssCallIndex", d.complete);
		var g = {
			linear : "linear",
			swing : "ease",
			easeIn : "ease-in",
			easeOut : "ease-out",
			easeInOut : "ease-in-out"
		};
		var h = {};
		var i = a("body").data("cssPerspective");
		if (c.transform)
			a.each(b, function (a, b) {
				var d = b + (b ? "T" : "t") + "ransform";
				var g = f.cssOriginal(e(d));
				var j = c.transform;
				if (!g || g == "none")
					h[d] = "scale(1)";
				c[d] = (i && !/perspective/gi.test(j) ? "perspective(" + i + ") " : "") + j
			});
		c = a.cssPropertySupporter(c);
		var j = [];
		a.each(c, function (a, b) {
			j.push(e(a))
		});
		var k = false;
		var l = [];
		var m = [];
		if (j != undefined) {
			for (var n = 0; n < j.length; n++) {
				l.push(String(d.duration / 1e3) + "s");
				var o = g[d.easing];
				m.push(o ? o : d.easing)
			}
			l = f.cssAnimationData("dur", l.join(", ")).join(", ");
			m = f.cssAnimationData("eas", m.join(", ")).join(", ");
			var p = f.cssAnimationData("prop", j.join(", "));
			f.data("identity", p.length - 1);
			p = p.join(", ");
			var q = {
				TransitionDuration : l,
				TransitionProperty : p,
				TransitionTimingFunction : m
			};
			var r = {};
			r = a.cssMerge(r, q, b);
			var s = c;
			a.extend(r, c);
			if (r.display == "callbackHide")
				k = true;
			else if (r.display)
				h["display"] = r.display;
			f.cssOriginal(h)
		}
		setTimeout(function () {
			f.cssOriginal(r);
			var b = f.data("runningCSS");
			b = !b ? s : a.extend(b, s);
			f.data("runningCSS", b);
			setTimeout(function () {
				f.data("cssCallIndex", "a");
				if (k)
					f.cssOriginal("display", "none");
				f.cssAnimationRemove();
				if (d.queue)
					f.cssRunQueue();
				if (typeof d.complete == "number") {
					f.data("cssCall")[d.complete].call(f);
					f.data("cssCall")[d.complete] = 0
				} else
					d.complete.call(f)
			}, d.duration)
		}, 0)
	};
	a.str2Speed = function (a) {
		return isNaN(a) ? a == "slow" ? 1e3 : a == "fast" ? 200 : 600 : a
	};
	a.fn.cssAnimate = function (b, c, d, e) {
		var f = this;
		var g = {
			duration : 0,
			easing : "swing",
			complete : function () {},
			queue : true
		};
		var h = {};
		h = typeof c == "object" ? c : {
			duration : c
		};
		h[d ? typeof d == "function" ? "complete" : "easing" : 0] = d;
		h[e ? "complete" : 0] = e;
		h.duration = a.str2Speed(h.duration);
		a.extend(g, h);
		if (a.cssAnimateSupport()) {
			f.each(function (c, d) {
				d = a(d);
				if (g.queue) {
					var e = !d.data("cssRunning");
					d.cssSetQueue(b, g);
					if (e)
						d.cssRunQueue()
				} else
					d.cssEngine(b, g)
			})
		} else
			f.animate(b, g);
		return f
	};
	a.cssPresetOptGen = function (a, b) {
		var c = {};
		c[a ? typeof a == "function" ? "complete" : "easing" : 0] = a;
		c[b ? "complete" : 0] = b;
		return c
	};
	a.fn.cssFadeTo = function (b, c, d, e) {
		var f = this;
		opt = a.cssPresetOptGen(d, e);
		var g = {
			opacity : c
		};
		opt.duration = b;
		if (a.cssAnimateSupport()) {
			f.each(function (b, d) {
				d = a(d);
				if (d.data("displayOriginal") != d.cssOriginal("display") && d.cssOriginal("display") != "none")
					d.data("displayOriginal", d.cssOriginal("display") ? d.cssOriginal("display") : "block");
				else
					d.data("displayOriginal", "block");
				g.display = c ? d.data("displayOriginal") : "callbackHide";
				d.cssAnimate(g, opt)
			})
		} else
			f.fadeTo(b, opt);
		return f
	};
	a.fn.cssFadeOut = function (b, c, d) {
		if (a.cssAnimateSupport()) {
			if (!this.cssOriginal("opacity"))
				this.cssOriginal("opacity", 1);
			this.cssFadeTo(b, 0, c, d)
		} else
			this.fadeOut(b, c, d);
		return this
	};
	a.fn.cssFadeIn = function (b, c, d) {
		if (a.cssAnimateSupport()) {
			if (this.cssOriginal("opacity"))
				this.cssOriginal("opacity", 0);
			this.cssFadeTo(b, 1, c, d)
		} else
			this.fadeIn(b, c, d);
		return this
	};
	a.cssPx2Int = function (a) {
		return a.split("p")[0] * 1
	};
	a.fn.cssStop = function () {
		var c = this,
		d = 0;
		c.data("cssAnimations", false).each(function (e, f) {
			f = a(f);
			var g = {
				TransitionDuration : "0s"
			};
			var h = f.data("runningCSS");
			var i = {};
			if (h)
				a.each(h, function (b, c) {
					c = isFinite(a.cssPx2Int(c)) ? a.cssPx2Int(c) : c;
					var d = [0, 1];
					var e = {
						color : ["#000", "#fff"],
						background : ["#000", "#fff"],
						"float" : ["none", "left"],
						clear : ["none", "left"],
						border : ["none", "0px solid #fff"],
						position : ["absolute", "relative"],
						family : ["Arial", "Helvetica"],
						display : ["none", "block"],
						visibility : ["hidden", "visible"],
						transform : ["translate(0,0)", "scale(1)"]
					};
					a.each(e, function (a, c) {
						if ((new RegExp(a, "gi")).test(b))
							d = c
					});
					i[b] = d[0] != c ? d[0] : d[1]
				});
			else
				h = {};
			g = a.cssMerge(i, g, b);
			f.cssOriginal(g);
			setTimeout(function () {
				var b = a(c[d]);
				b.cssOriginal(h).data({
					runningCSS : {},
					cssAnimations : {},
					cssQueue : [],
					cssRunning : false
				});
				if (typeof b.data("cssCallIndex") == "number")
					b.data("cssCall")[b.data("cssCallIndex")].call(b);
				b.data("cssCall", []);
				d++
			}, 0)
		});
		return c
	};
	a.fn.cssDelay = function (a) {
		return this.cssAnimate({}, a)
	};
	if (a.fn.cssOriginal != undefined)
		a.fn.css = a.fn.cssOriginal;
	a.fn.cssOriginal = a.fn.css;
	
	
	// SWIPE FUNCTION
	/**
	 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
	 * Common usage: wipe images (left and right to show the previous or next image)
	 * 
	 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
	 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
	 * @version 1.1 (1st September 2010) - support wipe up and wipe down
	 * @version 1.0 (15th July 2010)
	 */
	a.fn.swipe=function(b){if(!this)return false;var c={fingers:1,threshold:75,swipe:null,swipeLeft:null,swipeRight:null,swipeUp:null,swipeDown:null,swipeStatus:null,click:null,triggerOnTouchEnd:true,allowPageScroll:"auto"};var d="left";var e="right";var f="up";var g="down";var h="none";var i="horizontal";var j="vertical";var k="auto";var l="start";var m="move";var n="end";var o="cancel";var p="ontouchstart"in window,q=p?"touchstart":"mousedown",r=p?"touchmove":"mousemove",s=p?"touchend":"mouseup",t="touchcancel";var u="start";if(b.allowPageScroll==undefined&&(b.swipe!=undefined||b.swipeStatus!=undefined))b.allowPageScroll=h;if(b)a.extend(c,b);return this.each(function(){function J(){var a=I();if(a<=45&&a>=0)return d;else if(a<=360&&a>=315)return d;else if(a>=135&&a<=225)return e;else if(a>45&&a<135)return g;else return f}function I(){var a=y.x-z.x;var b=z.y-y.y;var c=Math.atan2(b,a);var d=Math.round(c*180/Math.PI);if(d<0)d=360-Math.abs(d);return d}function H(){return Math.round(Math.sqrt(Math.pow(z.x-y.x,2)+Math.pow(z.y-y.y,2)))}function G(a,b){if(c.allowPageScroll==h){a.preventDefault()}else{var l=c.allowPageScroll==k;switch(b){case d:if(c.swipeLeft&&l||!l&&c.allowPageScroll!=i)a.preventDefault();break;case e:if(c.swipeRight&&l||!l&&c.allowPageScroll!=i)a.preventDefault();break;case f:if(c.swipeUp&&l||!l&&c.allowPageScroll!=j)a.preventDefault();break;case g:if(c.swipeDown&&l||!l&&c.allowPageScroll!=j)a.preventDefault();break}}}function F(a,b){if(c.swipeStatus)c.swipeStatus.call(v,a,b,direction||null,distance||0);if(b==o){if(c.click&&(x==1||!p)&&(isNaN(distance)||distance==0))c.click.call(v,a,a.target)}if(b==n){if(c.swipe){c.swipe.call(v,a,direction,distance)}switch(direction){case d:if(c.swipeLeft)c.swipeLeft.call(v,a,direction,distance);break;case e:if(c.swipeRight)c.swipeRight.call(v,a,direction,distance);break;case f:if(c.swipeUp)c.swipeUp.call(v,a,direction,distance);break;case g:if(c.swipeDown)c.swipeDown.call(v,a,direction,distance);break}}}function E(a){x=0;y.x=0;y.y=0;z.x=0;z.y=0;A.x=0;A.y=0}function D(a){a.preventDefault();distance=H();direction=J();if(c.triggerOnTouchEnd){u=n;if((x==c.fingers||!p)&&z.x!=0){if(distance>=c.threshold){F(a,u);E(a)}else{u=o;F(a,u);E(a)}}else{u=o;F(a,u);E(a)}}else if(u==m){u=o;F(a,u);E(a)}b.removeEventListener(r,C,false);b.removeEventListener(s,D,false)}function C(a){if(u==n||u==o)return;var b=p?a.touches[0]:a;z.x=b.pageX;z.y=b.pageY;direction=J();if(p){x=a.touches.length}u=m;G(a,direction);if(x==c.fingers||!p){distance=H();if(c.swipeStatus)F(a,u,direction,distance);if(!c.triggerOnTouchEnd){if(distance>=c.threshold){u=n;F(a,u);E(a)}}}else{u=o;F(a,u);E(a)}}function B(a){var d=p?a.touches[0]:a;u=l;if(p){x=a.touches.length}distance=0;direction=null;if(x==c.fingers||!p){y.x=z.x=d.pageX;y.y=z.y=d.pageY;if(c.swipeStatus)F(a,u)}else{E(a)}b.addEventListener(r,C,false);b.addEventListener(s,D,false)}var b=this;var v=a(this);var w=null;var x=0;var y={x:0,y:0};var z={x:0,y:0};var A={x:0,y:0};try{this.addEventListener(q,B,false);this.addEventListener(t,E)}catch(K){}})}	

})(jQuery)