$(document).ready(function(){

    $('.toast').toast('show');

    $('#table_id').DataTable( {
        "language": {
            "url": "inc/italiano.lang.txt"
        }
    } );

    $("input[type='text']").keydown(function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            return false;
        }
    });

    $("[data-toggle='tooltip']").tooltip();
    
    $(".square-container").click(function(){
        $(this).toggleClass("active");
        $(".navbar").toggleClass("visible");
    });

    $(".square-container").click();
    
    $(".navbar").click(function(e){
        e.stopPropagation();
    });
    
    $(".navbar li.dynamic").click(function(){
        $(" ~ .submenu", this).slideToggle();
        $(this).children(".fa").toggleClass("rotated");
    });

    $(".single, .multi").click(function(){
        var id = 1
        if($(this).hasClass("multi"))
            id = 2
        $("input[name=tipologia]").val(id)
        $(".step-1, .step-2").slideToggle()
    })

    $(".backtostep1").click(function(){
        $(".step-1, .step-2").slideToggle()
    });

    $(".gotostep3, .backtostep2").click(function(){
        $(".step-3, .step-2").slideToggle()
    })

    $(".cro_gotostep2").click(function(){
        $(".cro_step-1, .cro_step-2").slideToggle()
    })

    $(".cro_gotostep3").click(function(){
        $(".cro_step-2, .cro_step-3").slideToggle()
    })

    $(".header, .popup").click(function(){
        var id = 2
        if($(this).hasClass("popup"))
            id = 1
        $("input[name=tipo_interazione]").val(id)
        $(".cro_step-3, .cro_step-4").slideToggle()
    });

    $(".cro_back_to_table").click(function(){
        location.href = "./cro.php"
    })

    $(".cro_backtostep1").click(function(){
        $(".cro_step-1, .cro_step-2").slideToggle()
    })

    $(".cro_backtostep2").click(function(){
        $(".cro_step-2, .cro_step-3").slideToggle()
    })

    $(".cro_backtostep3").click(function(){
        $(".cro_step-4, .cro_step-3").slideToggle()
    })

    $.ajax({
        url: "filterCRO.php",
        data: 0,
        success: (data) => {
            if(data)
                console.log(data)
            else
                console.log("no");
        },
      });
});