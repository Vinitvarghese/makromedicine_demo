var i           = 0;
var speed       = 300;
var bis         = '';
var txt         = 'Type here ...';

let imageArray  = [];
$(function(){
    $(document).on("mouseup", ".bootstrap-select .dropdown-header", function(){
        var $optgroup = $(this),
            $ul = $optgroup.closest("ul"),
            optgroup = $optgroup.data("optgroup"),
            $options = $ul.find("[data-optgroup=" + optgroup + "]").not($optgroup);
        $options.toggle();
        $optgroup.toggleClass("closed");
    });
    $(document).on("loaded.bs.select", function(){
        $(this).find(".dropdown-header.closed").each(function() {
            var $optgroup = $(this),
                $ul = $optgroup.closest("ul"),
                optgroup = $optgroup.data("optgroup"),
                $options = $ul.find("[data-optgroup=" + optgroup + "]").not($optgroup);
            $options.toggle();
        });
    });
});
(function($){
    $.fn.isOverflowWidth = function(){
        return this.each(function() {
            var el = $(this);
            if (el.css("overflow") == "hidden") {
                var text = el.html();
                var t = $(this.cloneNode(true)).hide().css('position', 'absolute').css('overflow', 'visible').width('auto').height(el.height());
                el.after(t);
                function width() {
                    return t.width() > el.width();
                };
                width();
            }
        });
    };
})
(jQuery);
(function($) {
    $.fn.isOverflowHeight = function() {
        return this.each(function() {
            var el = $(this);
            if (el.css("overflow") == "hidden") {
                var text = el.html();
                var t = $(this.cloneNode(true)).hide().css('position', 'absolute').css('overflow', 'visible').height('auto').width(el.width());
                el.after(t);
                function height() {
                    return t.height() > el.height();
                };
                height();
            }
        });
    };
})
(jQuery);
function isUrlValid(userInput) {
    var regexQuery = "^(https?://)?(www\\.)?([-a-z0-9]{1,63}\\.)*?[a-z0-9][-a-z0-9]{0,61}[a-z0-9]\\.[a-z]{2,6}(/[-\\w@\\+\\.~#\\?&/=%]*)?$";
    var url = new RegExp(regexQuery,"i");
    return url.test(userInput);
}

function testImage(url) {
    timeout =  5000;
    var timedOut = false, timer;
    var img = new Image();
    img.onerror = img.onabort = function() {
        if (!timedOut) {
            clearTimeout(timer);
            return false;
        }
    };
    img.onload = function() {
        if (!timedOut) {
            clearTimeout(timer);
            return true;
        }
    };
    img.src = url;
    timer = setTimeout(function() {
        timedOut = true;
        return false;
    }, timeout);
}

function typeWriter() {
    if (i < txt.length) {
        bis += txt.charAt(i);
        $('.search-pag .search-input').attr('placeholder', bis);
        i++;
        setTimeout(typeWriter, speed);
    }
    if (i == txt.length)
    {
        bis = '';
        $('.search-pag .search-input').attr('placeholder', bis);
        i = 0;
    }
}
function hamburger() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
function zIndex() { 
    /*$('.btn.dropdown-toggle').css('z-index', '10');
    $('.btn-group.bootstrap-select.form-control').css('z-index', '10');
    $('.btn-group.bootstrap-select.show-tick.show-menu-arrow').css('z-index', '10');*/
}
/*function checkOverflow(element){
    if (element.height() > 49)
        return true;
    else
      return false;
}*/
function checkOverflow(el) {
    var curOverflow = el.css("overflow");
    if (!curOverflow || curOverflow === "visible")
        el.css("overflow", "hidden");
    var isOverflowing = Math.round(el.height()) < el[0].scrollHeight;
    el.css("overflow", curOverflow);
    return isOverflowing;
    }
function changeLanguage(language) {
    var element = document.getElementById("url");
    element.value = language;
    element.innerHTML = language;
}
function showDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}
function appendData(limit, offset, key, periodic, types) {
    var clone = '';
    $.ajax({
        type: 'POST',
        url: site_url + 'product/ajax/',
        data: {
            'limit': limit,
            'offset': offset,
            'key': key,
            'periodic': periodic
        },
        cache: false,
        success: function(data) {
            console.log(data);
            $.each(data, function(key, value) {
                if (types == 'chemical')
                {
                    clone += '<li data-txt="' + value.meaning + '" data-no="' + value.atc_code + '" data-formula="" data-target="' + types + '" data-id="' + value.id + '">';
                    clone += '<a href="#">';
                    clone += '<div class="lib-span" data-toggle="tooltip" data-placement="right" title="' + value.meaning + '">' + value.atc_code + '</div>';
                    clone += '<div class="lib-span2"> | ' + value.meaning.substr(0, 15) + '</div>';
                    clone += '</a>';
                    clone += '<div class="clearfix"></div>';
                    clone += '</li>';
                } else if (types == 'herbal')
                {
                    clone += '<li data-txt="' + value.name + '" data-no="" data-formula="" data-target="' + types + '" data-id="' + value.id + '"> <a href="#" data-toggle="tooltip" data-placement="right" title="' + value.name + '">' + value.name + '</a> </li>';
                } else if (types == 'animal')
                {
                    clone += '<li data-txt="' + value.name + '" data-no="" data-formula="" data-target="' + types + '" data-id="' + value.id + '"> <a href="#" data-toggle="tooltip" data-placement="right" title="' + value.name + '">' + value.name + '</a> </li>';
                } else if (types == 'casNumber')
                {
                    clone += '<li data-txt="' + htmlEntities(value.chemical_name) + '" data-no="' + value.cas_no + '" data-formula="' + value.molecular_formula + '" data-target="' + types + '" data-id="' + value.id + '"> ';
                    clone += '<a href="#">';
                    clone += '<div class="lib-span3" data-toggle="tooltip" data-placement="right" title="' + htmlEntities(value.chemical_name) + '">' + value.cas_no + '</div>';
                    clone += '<div class="lib-span4">' + value.chemical_name+ '</div>';
                    clone += '<div class="lib-span5" >'+value.molecular_formula+'</div>';
                    clone += '</a>';
                    clone += '<div class="clearfix"></div>';
                    clone += '</li>';
                } else if (types == 'dossageForm')
                {
                    clone += '<li data-txt="' + value.name + '" data-no="" data-formula="" data-target="' + types + '" data-id="' + value.id + '"> <a href="#" data-toggle="tooltip" data-placement="right" title="' + value.name + '">' + value.name + '</a> </li>';
                } else if (types == 'medicalClassification')
                {
                    clone += '<li data-txt="' + value.name + '" data-no="" data-formula="" data-target="' + types + '" data-id="' + value.id + '"> <a href="#" data-toggle="tooltip" data-placement="right" title="' + value.name + '">' + value.name + '</a> </li>';
                } else
                {
                    return false;
                }
            });
            $(".discom ul.in").append(clone);
        }
    });
}
function removeImage() {
    $(document).on("click", ".remove-image", function() {
        let _this, image_delete;
        _this = $(this);
        image_delete = _this.parents(".reload-form-cover-mini");

        let file_input= _this.parents('.img-upload-group').find("input[type='file']");


       file_input.attr('id', 'file_item');

        image_delete.remove();

        document.querySelector('#file_item').value = '';

        setTimeout(() => {

            file_input.removeAttr("id");

        }, 100);

    })
}
function removeFullImage() {
    $(document).on("click", ".remove-image-full", function() {
        let _this, image_delete;
        _this = $(this);
        image_delete = _this.parents(".reload-form-cover");
        image_delete.remove();
    });
}
function mini_upload() {
    $(document).on("click", ".upload-button", function() {


        let create_cover, files, submit, imageFiles, _this, data_id, data_target;
        _this = $(this);
        files = _this.prev("input[type='file']");
        data_id = _this.attr('data-id');
        data_target = _this.attr('data-target');
        create_cover = `<div class="reload-form-cover-mini">
                            <img src="" title="" alt="" />
                            <button type="button" class="remove-image">  </button>
                        </div>`;
        files.trigger('click');
        files.on("change", function(e) {
            const files = e.target.files;
            if (files.length !== 0) {
                var par=_this.parents(".reload-form-upload");
                par.next('.reload-form-cover-mini').remove();

                par.after(create_cover);
                removeImage();
            }
            const fileName = files[0].name;
            const fileReader = new FileReader();
            fileReader.addEventListener('load', () => {
                console.log(fileReader);
                submit = fileReader.result;
                if(!submit.includes('application/pdf'))
                _this.parents(".reload-form-upload").next().find("img").attr("src", submit);
                else
                _this.parents(".reload-form-upload").next().find("img").attr("src", "https://makromedicine.com/templates/default/assets/img/sys/pdf.png?v=2")
                .attr("class","pdf-icon-st");
            });
            fileReader.readAsDataURL(files[0]);
            imageArray.push(files[0]);
        });
    });
}
function bigUpload() {
    $(document).on("click", ".upload-big-button", function() {
        let _this, create_cover, files, submit, fake_image;
        _this = $(this);
        files = _this.prev("input[type='file']");
        create_cover = `<div class="reload-form-cover">
                            <img src="" title="" alt="" />
                            <button type="button" class="remove-image-full">  </button>
                        </div>`;
        files.trigger('click');
        files.on("change", function(e) {
            const files = e.target.files;
            if (files.length !== 0) {
                _this.parents(".reload-form-upload").after(create_cover);
                removeFullImage();
            }
            const fileName = files[0].name;
            const fileReader = new FileReader();
            fileReader.addEventListener('load', () => {
                submit = fileReader.result;
                _this.parents(".reload-form-upload").next().find("img").attr("src", submit);
            });
            fileReader.readAsDataURL(files[0]);
            imageArray.push(files[0]);
        });
    })
}
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

function getChemical(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_chemical/',
        data: {'chemical_id':param},
        async: false
    });
}
function getHerbal(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_herbal/',
        data: {'herbal_id':param},
        async: false
    });
}
function getAnimal(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_animal/',
        data: {'animal_id':param},
        async: false
    });
}
function getCasNumber(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_cas_number/',
        data: {'cas_number_id':param},
        async: false
    });
}
function getPackingType(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_packing_type/',
        data: {'packing_type_id':param},
        async: false
    });
}
function getMedicalClass(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_medical_class/',
        data: {'medical_id':param},
        async: false
    });
}
function getProductType(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/get_product_type/',
        data: {'product_type_id':param},
        async: false
    });
}
function getUnitName(param) {
    return $.ajax({
        type:'POST',
        url:site_url+'product/volume_unit/',
        data: {'unit_id':param},
        async: false
    });
}


function search_type_event()
{
    // HIDE
    $('.advanced-menu').hide();
    $('.advanced-serach-icon').hide();
    $('.show-menu-arrow.main_product_type').hide();
    $('.show-menu-arrow.main_company_name').hide();
    // SHOW
    $('.show-menu-arrow.main_event_type').show();
    $('.show-menu-arrow.main_event_continent').show();
    $('.show-menu-arrow.country-inner-event').show();
    $('.show-menu-arrow.data-event').show();
    // TRIGGER
    $('.show-menu-arrow.main_event_continent').trigger('change');
}

function search_type_chemical()
{
    // HIDE
    $('.bootstrap-select.main_event_type').hide();
    $('.bootstrap-select.main_event_continent').hide();
    $('.bootstrap-select.country-inner-event').hide();
    $('.bootstrap-select.data-event').hide();
    // SHOW
    $('.advanced-menu').hide();
    $('.advanced-serach-icon').show();
    $('.show-menu-arrow.main_product_type').show();
    $('.show-menu-arrow.main_company_name').show();
    // TRIGGER
    $('.show-menu-arrow.main_company_continent').trigger('change');
}

function search_type_tender()
{
    $('.bootstrap-select.main_event_type').hide();
    $('.bootstrap-select.main_event_continent').hide();
    $('.bootstrap-select.country-inner-event').hide();
    $('.bootstrap-select.data-event').hide();
    $('.advanced-menu').hide();
    $('.advanced-serach-icon').hide();
    $('.show-menu-arrow.main_product_type').hide();
    $('.show-menu-arrow.main_company_name').hide();
}

function search_type_equipment()
{
    $('.bootstrap-select.main_event_type').hide();
    $('.bootstrap-select.main_event_continent').hide();
    $('.bootstrap-select.country-inner-event').hide();
    $('.bootstrap-select.data-event').hide();
    $('.advanced-menu').hide();
    $('.advanced-serach-icon').hide();
    $('.show-menu-arrow.main_product_type').hide();
    $('.show-menu-arrow.main_company_name').hide();
}

function search_type_company()
{
    $('.bootstrap-select.main_event_type').hide();
    $('.bootstrap-select.main_event_continent').hide();
    // $('.bootstrap-select.country-inner-event').hide();
    $('.bootstrap-select.data-event').hide();
    $('.advanced-menu').hide();
    $('.advanced-serach-icon').hide();
    $('.show-menu-arrow.main_status_type2').show();
    $('.show-menu-arrow.main_event_continent').show();
    $('.show-menu-arrow.main_company_name').hide();
    // $('.show-menu-arrow.main_event_country').hide();
}
