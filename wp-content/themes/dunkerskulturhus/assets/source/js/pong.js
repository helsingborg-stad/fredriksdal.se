var ballspeed = 20;
var pong = new Pong(document.getElementById('pong-game'));

// Style
pong.setBackgroundColor('#1E1E1E');
pong.setTextStyle({
    font: '60px Impact, Charcoal, sans-serif'
});

// Add keyboard controls for player A
pong.players.a.addControls({
    'up': 'up',
    'down': 'down',
});

// Add behaviour for player B
Fö

/*
pong.on('update', function () {
    if (pong.players.a.y < pong.balls[0].y) {
        pong.players.a.move(1);
    } else if (pong.players.a.y > pong.balls[0].y) {
        pong.players.a.move(-1);
    }
});
*/

jQuery(window).on('resize', function () {
    pong.resize();
});
