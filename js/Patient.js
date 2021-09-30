function cpfChange(cpfValue)
{
    var numeric = cpfValue.replace(/[^0-9]+/g, '');
    var cpfLength = numeric.length;

    var partOne = numeric.slice(0, 3) + ".";
    var partTwo = numeric.slice(3, 6) + ".";
    var partThree = numeric.slice(6, 9) + "-";

    var cpfInput = document.getElementById("cpf"); // here is the CPF ID of the input

    var arr = 
    [  
        cpfLength < 4,
        cpfLength >= 4 && cpfLength < 7,
        cpfLength >= 7 && cpfLength < 10,
        cpfLength >= 10 && cpfLength < 12,
        cpfLength >= 12
    ]; 

    var index = arr.indexOf( true );

    switch (index)
    {
        case 0:
            cpfInput.value = numeric;
        break;
        
        case 1:
            var formatCPF = partOne +
                numeric.slice(3);
                cpfInput.value = formatCPF;
        break;
        
        case 2:
            var formatCPF = partOne +
            partTwo +
            numeric.slice(6);
            cpfInput.value = formatCPF;
        break;
        
        case 3:
            var formatCPF = partOne +
                    partTwo +
                    partThree +
                    numeric.slice(9);
                    cpfInput.value = formatCPF;
        break;
        
        case 4:
            var formatCPF = partOne +
                    partTwo +
                    partThree +
                    numeric.slice(9, 11);
                    cpfInput.value = formatCPF;
        break;
    }
}

function isInteger( el )
{
    el.value = /^-?\d*$/.test(el.value) ? el.value : el.value.substring( 0 , el.value.length - 1 );
}

function  validateDateFormat(el, format)
{
    var numerics = el.value.replace(/[^0-9]+/g, '');
    
    if( format == 'dd/MM/yyyy' )
    {
        var part1 = numerics.slice( 0 , 2 ) + "/";
        var part2 = numerics.slice( 2 , 4 ) + "/"; 
        var part3 = numerics.slice( 4 , 8 ) + "";

        var length = numerics.length;

        var verify =
        [
            length < 3,
            length >= 3 && length < 5,
            length >= 5 && length <= 8,
            length >= 9
        ]


        switch (verify.indexOf( true ))
        {
            case 0:
                el.value = numerics;
                break;
        
            case 1:
                el.value = part1 + numerics.slice(2);
                break;

            case 2:
                el.value = part1 + part2 + numerics.slice( 4 );
                break;
            case 3: 
                el.value = part1 + part2  + part3
            break
            default:
                el.value = part1 + part2 + part3 + numerics.slice(8, 11);;
                break;
        }
    }
}

var btn = document.getElementById( 'submit-btn' );


btn.addEventListener( 'click', function()
{
    setTimeout(() =>
    {
        
        this.style.backgroundColor = '#2ae904';
    }, 100);

    this.style.backgroundColor = '#25cc04';
} );