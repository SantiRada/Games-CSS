function CreateConfetti(){
  var end = Date.now() + (10 * 50); // Reduce la duración del confetti

  var colors = ['#eb0a74', '#70a9a1', '#cfe0c3'];

  (function frame() {
    confetti({
      particleCount: 2,
      angle: 60,
      spread: 55,
      origin: { x: 0 },
      colors: colors
    });
    confetti({
      particleCount: 2,
      angle: 120,
      spread: 55,
      origin: { x: 1 },
      colors: colors
    });

    if (Date.now() < end) {
      requestAnimationFrame(frame);
    }
  }());
}
