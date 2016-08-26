$(document).ready(function()
	{
		var road = $('#J_mayigogo'),
        mayis = road.find('.am-mayi');

        function toJson(str){
            return eval('('+str+')');
        }

        mayis.each(function()
		{
            var mayi = $(this),
                mayiSize = mayi.width(),
                opt = toJson(mayi.data('opt')),
                speed = opt.speed,
                delay = opt.delay; // 秒

            if(mayi.hasClass('disabled')) return;

            function mayiToGo()
			{
                mayi.css({
                    'right': '+=' + speed
                });

                setTimeout(function(){
                    var left = mayi.offset().left;
                    if(left < 0 && left + mayiSize < 0) {
                        mayi.css({
                            'right': -50
                        });
                    }
                    mayiToGo()
                }, 100);
            }

            setTimeout(function(){
                mayiToGo();
            }, delay * 1000);
        });
})