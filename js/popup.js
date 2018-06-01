var poped = false;


$("#zoom").click(function () {
    console.log('Bla');

    if (poped)
    {
        poped = false;
        //first number after id is seconds to start the animation
        TweenMax.to("#zoom", 1,
            {
                scaleX: 1,
                scaleY: 1,
                ease: Power4.easeIn



            });
    }
    else
    {
        poped = true;
        TweenMax.to("#zoom", 1,
            {
                scaleX: 2,
                scaleY: 2,
                ease: Power4.easeIn



            });
    }

    


});