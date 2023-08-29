$(function(){
    'use strict';

    //dashboard


    // hide placeholder on form focus
    $('[placeholder]').focus(function(){

       $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');

    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    })


     var passField = $('.password');
    $('.show-pass').hover(function () {
         passField.attr('type','text');
        }, function(){
        passField.attr('type','password');
        }
    );

    // confirmation message on button
    $('.confirm').click(function (){
        return confirm('Are you sure ?');
    });

    //product


    // const body = document.querySelector('body'),
    //     sidebar = body.querySelector('nav'),
    //     toggle = body.querySelector(".toggle"),
    //     searchBtn = body.querySelector(".search-box"),
    //     modeText = body.querySelector(".mode-text");
    //
    //
    // toggle.addEventListener("click" , () =>{
    //     sidebar.classList.toggle("close");
    //
    // })
    //
    // searchBtn.addEventListener("click" , () =>{
    //     sidebar.classList.remove("close");
    // })
    //

});