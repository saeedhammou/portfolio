'use strict';

//BG for the canvas
if (document.body.classList.contains("body-style-dark")) {
    var cbg_color = document.getElementById("canvas_matrix_bg").dataset.cbgd;
} else {
    var cbg_color = document.getElementById("canvas_matrix_bg").dataset.cbg;
}

//Codes for the canvas
if (document.body.classList.contains("body-style-dark")) {
    var ctx_color = document.getElementById("canvas_matrix").dataset.ctxd;
} else {
    var ctx_color = document.getElementById("canvas_matrix").dataset.ctx;
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
      r: parseInt(result[1], 16),
      g: parseInt(result[2], 16),
      b: parseInt(result[3], 16)
    } : null;
}

// geting canvas by Boujjou Achraf
var c = document.getElementById("canvas_matrix");
var ctx = c.getContext("2d");

//making the canvas full screen
c.height = window.innerHeight;
c.width = window.innerWidth;

//characters - taken from the unicode charset
var matrix = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@#$%^&*()*&^%+-/~{[|`]}";
//converting the string into an array of single characters
matrix = matrix.split("");
var font_size = 10;
var columns = c.width/font_size;
var drops = [];
for(var x = 0; x < columns; x++)
drops[x] = 1;

//drawing the characters
function draw()
{
    //BG for the canvas
    if (document.body.classList.contains("body-style-dark")) {
        cbg_color = document.getElementById("canvas_matrix_bg").dataset.cbgd;
    } else {
        cbg_color = document.getElementById("canvas_matrix_bg").dataset.cbg;
    }
    if (cbg_color.length > 1) {
        ctx.fillStyle = "rgba("+hexToRgb(cbg_color).r+","+hexToRgb(cbg_color).g+","+hexToRgb(cbg_color).b+","+"0.04)";
    } else {
        ctx.fillStyle = "rgba(0, 0, 0, 0.04)";
    }
    ctx.fillRect(0, 0, c.width, c.height);

    //Codes for the canvas
    if (document.body.classList.contains("body-style-dark")) {
        ctx_color = document.getElementById("canvas_matrix").dataset.ctxd;
    } else {
        ctx_color = document.getElementById("canvas_matrix").dataset.ctx;
    }
    if (ctx_color.length > 1) {
        ctx.fillStyle = ctx_color;
    } else {
        ctx.fillStyle = "#f4427d";
    }
    
    ctx.font = font_size + "px arial";

    //looping over drops
    for(var i = 0; i < drops.length; i++)
    {
        //a random chinese character to print
        var text = matrix[Math.floor(Math.random()*matrix.length)];
        ctx.fillText(text, i*font_size, drops[i]*font_size);

        //sending the drop back to the top randomly after it has crossed the screen
        //adding a randomness to the reset to make the drops scattered on the Y axis
        if(drops[i]*font_size > c.height && Math.random() > 0.975)
            drops[i] = 0;

        //incrementing Y coordinate
        drops[i]++;
    }
}

setInterval(draw, 35);
