if (document.body.classList.contains("body-style-dark")) {
  var particles_color_1 = document.getElementById("canvas_spiral").dataset.coloroned;
} else {
  var particles_color_1 = document.getElementById("canvas_spiral").dataset.colorone;
}

function hexToRgb(hex) {
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

var canvas    = document.getElementById('canvas'),
    ctx       = canvas.getContext('2d'),
	  perlin    = new ClassicalNoise(),
    variation = .0025,
    amp       = 300,
    variators = [],
    max_lines = (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) ? 25 : 40,
    canvasWidth,
    canvasHeight,
    start_y;

for (var i = 0, u = 0; i < max_lines; i++, u+=.02) {
  variators[i] = u;
}

function draw(){
  if (document.body.classList.contains("body-style-dark")) {
    particles_color_1 = document.getElementById("canvas_spiral").dataset.coloroned;
  } else {
    particles_color_1 = document.getElementById("canvas_spiral").dataset.colorone;
  }
  if (particles_color_1.length > 1) {
    ctx.shadowColor = "rgb("+hexToRgb(particles_color_1).r+","+hexToRgb(particles_color_1).g+","+hexToRgb(particles_color_1).b+")";
  } else {
    ctx.shadowColor = "rgb(249,249,249)";
  }
  
  ctx.shadowBlur = 0;

  for (var i = 0; i <= max_lines; i++){
    ctx.beginPath();
    ctx.moveTo(0, start_y);
    for (var x = 0; x <= canvasWidth; x++) {
      var y = perlin.noise(x*variation+variators[i], x*variation, 0);
      ctx.lineTo(x, start_y + amp*y);
    }
    var color = Math.floor(150*Math.abs(y));
    var alpha = Math.min(Math.abs(y)+0.05, .05);
    if (particles_color_1.length > 1) {
      ctx.strokeStyle = "rgba("+hexToRgb(particles_color_1).r+","+hexToRgb(particles_color_1).g+","+hexToRgb(particles_color_1).b+","+alpha*2+")";
    } else {
      ctx.strokeStyle = "rgba(255,255,255,"+alpha*2+")";
    }
    ctx.stroke();
    ctx.closePath();

    variators[i] += .005;
  }
}

(function init() {
	resizeCanvas();
	animate();
	window.addEventListener('resize', resizeCanvas);
})();

function animate() {
  ctx.clearRect(0, 0, canvasWidth, canvasHeight);
  draw();
  requestAnimationFrame(animate);
}

function resizeCanvas(){
	canvasWidth = document.documentElement.clientWidth,
	canvasHeight = document.documentElement.clientHeight;

	canvas.setAttribute("width", canvasWidth);
	canvas.setAttribute("height", canvasHeight);

	start_y = canvasHeight/2;
}
