if (document.body.classList.contains("body-style-dark")) {
  var snake_bg_color = document.getElementById("canvas_snake").dataset.coloroned;
} else {
  var snake_bg_color = document.getElementById("canvas_snake").dataset.colorone;
}
var snake_line_color = document.getElementById("canvas_snake").dataset.colortwo;

function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

var c = document.createElement('canvas'),
    $ = c.getContext('2d'),
    w = c.width = innerWidth,
    h = c.height = innerHeight,
    lines = [],
    lineCount = 50;

document.getElementById("canvas_snake").appendChild(c).style.display = 'block';

function init() {
  for (var i = 0; i < lineCount; i++)
    lines.push(new Line());
  stage();
  loop();
}

function stage() {
  w = c.width = innerWidth;
  h = c.height = innerHeight;
  $.fillStyle = snake_bg_color;
  $.fillRect(0, 0, w, h);
}

function Line() {
  this.location = {
    x: Math.random() * w,
    y: Math.random() * h
  };
  this.width = Math.random() * 1 + 0.25;
  this.color = snake_line_color;
}

function draw() {

  //BG for the canvas
  if (document.body.classList.contains("body-style-dark")) {
    snake_bg_color = document.getElementById("canvas_snake").dataset.coloroned;
  } else {
    snake_bg_color = document.getElementById("canvas_snake").dataset.colorone;
  }
  if (snake_bg_color.length > 1) {
    $.fillStyle = "rgba("+hexToRgb(snake_bg_color).r+","+hexToRgb(snake_bg_color).g+","+hexToRgb(snake_bg_color).b+","+"0.05)";
  } else {
    $.fillStyle = 'rgba(11, 17, 21, 0.05)';
  }

  
  $.fillRect(0, 0, w, h);
  for (var i = 0; i < lines.length; i++) {
    var l = lines[i],
        a = ~~(Math.random() * 4) * 90,
        lL = Math.random() * 15 + 5;
    $.lineWidth = l.width;
    $.strokeStyle = l.color;
    $.beginPath();
    $.moveTo(l.location.x, l.location.y);
    switch(a) {
      case 0:
        l.location.y -= lL;
        break;
      case 90:
        l.location.x += lL;
        break;
      case 180:
        l.location.y += lL;
        break;
      case 270:
        l.location.x -= lL;
        break;
      default:
        break;
    }
    $.lineTo(l.location.x, l.location.y);
    if (l.location.x < 0 || l.location.x > w)
      l.location.x = Math.random() * w;
    if (l.location.y < 0 || l.location.y > h)
      l.location.y = Math.random() * h;
    $.stroke();
  }
}

function loop() {
  draw();
  requestAnimationFrame(loop);
}

window.addEventListener('resize', stage);

init();
