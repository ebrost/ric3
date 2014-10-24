/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//container
$(function() {
    var Ric = window.Ric || {};
    Ric.uploader = function(model, container, browse_button, droparea, filelist, valid_extensions) {

        var uploader = new plupload.Uploader({
            runtimes: 'html5,flash',
            browse_button: browse_button,
            container: container,
            drop_element: droparea,
            url: '../ajaxUploadMedia',
            multipart_params: {'model': model},
            filters: {
                // max_file_size: '10mb',
                mime_types: [
                    {title: "Fichiers acceptés", extensions: valid_extensions},
                ]
            },
            // Flash settings
            flash_swf_url: '/plupload/js/Moxie.swf',
            init: {
                PostInit: function() {
                    // document.getElementById('filelist').innerHTML = '';
                    $('#' + droparea).bind({
                        dragover: function(e) {
                            $(this).addClass('dropping');
                        },
                        dragleave: function(e) {
                            $(this).removeClass('dropping');
                        }
                    });

                },
                FilesAdded: function(up, files) {

                    var filelist_media = $("#" + filelist);
                    console.log(filelist_media);
                    plupload.each(files, function(file) {
                        filelist_media.prepend('<div id="' + file.id + '" class="file panel"><div class="panel-body">' + file.name + ' (' + plupload.formatSize(file.size) + ')' + '<div class="progress progress-striped active"><div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"  ></div></div></div></div>');
                    });
                    $('#' + droparea).removeClass('dropping');
                    uploader.start();
                    uploader.refresh();
                },
                FileUploaded: function(up, file, response) {
                    console.log(response);
                    var data = $.parseJSON(response.response);

                    if (data.error) {
                        alert(data.error);

                    }
                    else {
                        // console.log(file);
                        $('#' + file.id).before(data.content);
                    }
                    $('#' + file.id).remove();

                },
                UploadProgress: function(up, file) {
                    // document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    $('#' + file.id).find('.progress-bar').css('width', file.percent + '%')
                },
                Error: function(up, err) {
                    console.log(err)
                    // $("#console").innerHTML += "\nError #" + err.code + ": " + err.message;
                    uploader.refresh();
                    $('#' + droparea).removeClass('dropping');
                }
            }
        });

        uploader.init();

        //suppression
        $('#' + filelist).on('click', 'a.deleteMedia', function(e) {
            e.preventDefault();
            elem = $(this);
            if (confirm('Voulez vous supprimer ce media ?\nTous les liens existants seront supprimés')) {
                $.post(elem.attr('href'), {}, function(data) {
                    elem.parents('.file').slideUp();
                });
            }

        });

        //edition des medias
        var basename = 'AdministrationUserEditMedia';
        var mediaEditForm = $("." + basename);
        mediaEditForm.submit(function() {
            var that = $(this);

            $.ajax({
                type: that.attr('method'),
                dataType: 'json',
                url: that.attr('action'),
                data: that.serialize(),
                success: function(data) {
                    if (data.error) {
                        alert(data.error);
                        return false;
                    }
                    else {

                        $.each(data, function(key, element) {
                            if (element) {
                                if (key == "copyright")
                                    element = "© " + element;
                                $('#' + model + '-' + data.id).find('.' + key).html(element);
                            }
                            $('#' + model + '-' + data.id).find('.editMedia').trigger('click')
                            //  $('#'+basename+key.charAt(0).toUpperCase() + key.substring(1)).val(element)

                        });
                    }
                }
            })
            return false;
        })
        //pour accordeon
        $('a[data-toggle="collapse"]').attr('data-parent', '#' + filelist);
    };

    Ric.selectMedias = function(container) {
        console.log('selectMedias')
        var form = $('#' + container).find('form');
        console.log('form');
        form.find(".selected").on("sortupdate", function(event, ui) {
            console.log('sortupdate');console.log(form.serialize());
            var i = 0;
            form.find(" input[data-attr='order']").each(function() {
                i++;
                console.log(i);
                $(this).val(i);
            });
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: form.attr('action'),
                data: form.serialize(),
                success: (function(response) {
                    if (response.errors) {
                          BootstrapDialog.show({title:'Erreur',type:'type-danger',message:response.error});
                    }
                    else {
                        valid = true;
                    }
                })
            });
        });
        $('#'+container).find(' .selected, .unselected').sortable({
            connectWith: "#"+container+" .connectedSortable",
            placeholder: "placeholder",
        }).disableSelection();
    };
})
