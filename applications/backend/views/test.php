<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Webrocom Codeigniter tutorial</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.min.css" rel="stylesheet"/>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/jquery.colorbox-min.js"></script>
        <style>#loader{display: none}</style>
         
    </head>
    <body>
        <div class="container">
            <img id="loader" src="<?php echo base_url()?>asset/712.GIF" style="position: absolute; left: 45%; background: #ff9900; padding: 5px; width: 50px; box-shadow: 0px 0px 3px #333"/>
<div class="row clear_fix">
                    <div class="col-md-12" style="position: relative">
                            <blockquote>
                                <h3>Create, Read, Update and Delete Records in codeigniter using Ajax<small>By vikram parihar</small></h3>
                                <small><a href="http://webrocom.net/delete-multiple-recoed-based-checkbox-using-ajax-php-codeigniter/">Back to Article</a></small>
                            </blockquote>  
                            <style>
                                 
                                div #fb, div #gp, div #tw{display: inline-block;}
                                #fb{width: 180px;}
                                #gp{width:  100px;}
                                #tw{width: 180px;}
                            </style>
                            <div id="fb">
                                <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fwebrocom.learn&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=true&amp;height=21&amp;appId=1464599523806855" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
                            </div>
                            <div id="tw">
                                <a href="https://twitter.com/webrocom" class="twitter-follow-button" data-show-count="false" data-size="medium">Follow @webrocom</a>
                                <script>!function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + '://platform.twitter.com/widgets.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'twitter-wjs');</script>
                            </div>
                            <div id="gp">
                                <!-- Place this tag in your head or just before your close body tag. -->
                                <script src="https://apis.google.com/js/platform.js" async defer></script>
                                <!-- Place this tag where you want the +1 button to render. -->
                                <div class="g-plusone" data-href="https://plus.google.com/+WebrocomNetwebrocom/about"></div>
                            </div>
                        </div>
                    </div>
 
<div class="row clear_fix">
    <div class="col-md-12">
 
        <div id="response"></div>
 
        <div class="well">
            <form class="form-inline" role="form" id="frmadd" action="<?php echo base_url() ?>home/create" method="POST">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Full name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail2" placeholder="name">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">@</div>
                        <input class="form-control" name="email" type="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Contact</label>
                    <input type="text" class="form-control" name="contact" id="exampleInputPassword2" placeholder="contact number">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">facebook link</label>
                    <input type="text" name="facebook" class="form-control" id="exampleInputPassword2" placeholder="http://facebook.com/pariharvikram1989">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="submit">
                </div>
            </form>
        </div>
 
        <table class="table">
            <thead><tr><th>Yard Type</th><th>Vessel Type</th><th>Alloted Slots</th></tr></thead>
            <tbody id="fillgrid">
             
            </tbody>
            <tfoot></tfoot>
        </table>
 
 
    </div>
</div>
</div>
 
 
 
<script>
$(document).ready(function (){
    //fill data
    var btnedit='';
    var btndelete = '';
        fillgrid();
        // add data
        $("#frmadd").submit(function (e){
            e.preventDefault();
            $("#loader").show();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url:url,
                type:'POST',
                data:data
            }).done(function (data){
                $("#response").html(data);
                $("#loader").hide();
                fillgrid();
            });
        });
     
     
     
    function fillgrid(){
        $("#loader").show();
        $.ajax({
            url:"<?php echo site_url('yard_vessel/fillgrid')",
            type:'GET'
        }).done(function(data){
            $("#fillgrid").html(data);
            $("#loader").hide();
            btnedit = $("#fillgrid .btnedit");
            btndelete = $("#fillgrid .btndelete");
            var deleteurl = btndelete.attr('href');
            var editurl = btnedit.attr('href');
            //delete record
            btndelete.on('click', function (e){
                e.preventDefault();
                var deleteid = $(this).data('id');
                if(confirm("are you sure")){
                    $("#loader").show();
                    $.ajax({
                    url:deleteurl,
                    type:'POST' ,
                    data:'id='+deleteid
                    }).done(function (data){
                    $("#response").html(data);
                    $("#loader").hide();
                    fillgrid();
                    });
                }
            });
             
            //edit record
            btnedit.on('click', function (e){
                e.preventDefault();
                var editid = $(this).data('id');
                $.colorbox({
                href:"<?php echo base_url()?>home/edit/"+editid,
                top:50,
                width:500,
                onClosed:function() {fillgrid();}
                });
            });
             
        });
    }
     fillgrid();
});
</script>
</body>
</html>