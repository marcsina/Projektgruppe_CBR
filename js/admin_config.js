var count_of_Sliders = 0;
var i = 0;

//Update slider when page is loaded, due to the circumstance that forms, are not reseting
updateSlider( $( "#add_new_Category_Slider" ).val(), "add_new_Category_Slider_Value" );

//update new Category Slider
function updateSlider( slideAmount, textField )
{

    $( "#" + textField ).text( "Gewicht: " + Math.round( slideAmount * 100 ) / 100 + "%" );
}

//remove category from list
function removeFromList( name )
{
    $( "#" + name ).remove();
}

//switch between tabs
$( ".nav-tabs a" ).click( function () { $( this ).tab( 'show' ); } );

///STUFF FOR ADD CATEGORY

//create new items in list
function add_Item_to_Category_list( kategorie_name, sliderValue )
{
    //String for sliderupdate
    var string_1 = "updateSlider( this.value, 'slider_value_" + count_of_Sliders + "')";
    //Command for deleting list item
    var string_2 = "removeFromList('li_ID_" + count_of_Sliders + "')";
    //ADD BOX AROUND LIST
    if ( $( "#list_of_Category_admin" ).children().length === 0 )
    {
        $( "#list_of_Category_admin" ).addClass( "list_admin" );
    }
    //CREATE NEW LIST ITEM WITH SLIDER ETC.
    $( "#list_of_Category_admin" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Category_Name" ).attr( 'id', "Category_list_name" + count_of_Sliders ).append
                ( "<B>" + kategorie_name + "</B>" )
            ).append
            ( $( '<p>' ).attr( 'id', "slider_value_" + count_of_Sliders ).attr( 'class', "Slider_Value" ).append( "Gewicht: " + Math.round( sliderValue * 100 ) / 100 + "%" ) ).append
            ( $( '<input>' ).attr( 'type', "range" ).attr( 'min', "0" ).attr( 'max', "100" ).attr( 'value', Math.round( sliderValue * 100 ) / 100 ).attr( 'class', "slider" ).attr( 'id', "slider" + count_of_Sliders ).attr( 'onchange', string_1 )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++
}

function add_Item_to_Category_list_AREADY_THERE( kategorie_name, sliderValue, sliderID )
{
    var string1 = "slider_value_" + sliderID;
    $( "#" + string1 ).text( "Gewicht: " + sliderValue + "%" );
    var string2 = "slider" + sliderID;
    $( "#" + string2 ).val( sliderValue );
}

//Add things to list 
$( "#btn_add_new_Category" ).click( function ( event )
{
    for ( i = 0; i < count_of_Sliders; i++ )
    {
        var string = "Category_list_name" + i;
        if ( $( "#add_new_Category" ).val() === $( "#" + string ).text() )
        {
            add_Item_to_Category_list_AREADY_THERE( $( "#add_new_Category" ).val(), $( "#add_new_Category_Slider" ).val(), i );
        }

    }
    if ( $( "#add_new_Category" ).val() != "" )
    {
        add_Item_to_Category_list( $( "#add_new_Category" ).val(), $( "#add_new_Category_Slider" ).val() );
    }
    else
        alert( "Eingabefeld leer!" );
}
);

//Search for keywords in text
$( "#btn_search_Text" ).click( function ( event )
{
    //TODO 
    var text = $( "#text_admin" ).val();
    var weighted_category_array = extractKeywords( text );
    for ( i = 0; i < weighted_category_array.length; i++ )
    {
        if ( weighted_category_array[i].katName != "" && weighted_category_array[i].weight != "NaN" )
            add_Item_to_Category_list( weighted_category_array[i].katName, weighted_category_array[i].weight * 100 );
    }
} );

$( "#btn_add_Case_to_DataBase" ).click( function ( event )
{
    if ( $( "#add_New_Case_Name" ).val() != "" )
    {
        if ( $( "#list_of_Category_admin" ).children().length > 0 )
        {
            var array_of_keywords = new Array();
            for ( i = 0; i < $( "#list_of_Category_admin" ).children().length; i++ )
            {
                array_of_keywords.push( $( "#list_of_Category_admin>li>p.Category_Name" ).get( i ).innerText );
            }
            //TODO ADD CASE TO DB
            alert( "YAY\n" + array_of_keywords );
        }
        else
            alert( "Liste leer" );
    }
    else
        alert( "Eingabefeld leer!" );
} );

//STUFF FOR ADD KEYWORD
$( "#btn_add_new_Keyword" ).click( function ( event )
{
    var isAlreadyOnList = false;
    for ( i = 0; i < count_of_Sliders; i++ )
    {
        var string = "Keyword_list_name" + i;
        if ( $( "#add_new_Keyword" ).val() === $( "#" + string ).text() )
        {
            isAlreadyOnList = true;
        }

    }
    if ( $( "#add_new_Keyword" ).val() != "" )
    {
        if ( isAlreadyOnList === false )
            add_Item_to_Keyword_list( $( "#add_new_Keyword" ).val() );
        else
            alert( "Keyword schon auf der Liste" );
    } else
        alert( "Eingabefeld leer!" );
}
);
//ADD ITEM TO KEYWORD LIST
function add_Item_to_Keyword_list( Keyword_name )
{
    //String for list ID
    var string_2 = "removeFromList('li_ID_" + count_of_Sliders + "')";
    //Command for deleting list item
    if ( $( "#list_of_Keywords_admin" ).children().length === 0 )
    {
        $( "#list_of_Keywords_admin" ).addClass( "list_admin" );
    }
    //ADDING LIST ITEM
    $( "#list_of_Keywords_admin" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Keyword_Name" ).attr( 'id', "Keyword_list_name" + count_of_Sliders ).append
                ( "<B>" + Keyword_name + "</B>" )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++
}

//CLICKING BUTTON TO ADD KATEGORIE TO DB
$( "#btn_add_Category_to_DataBase" ).click( function ( event )
{
    if ( $( "#add_new_Category_Category_Name" ).val() != "" )
    {
        if ( $( "#list_of_Keywords_admin" ).children().length > 0 )
        {
            var array_of_keywords = new Array();
            for ( i = 0; i < $( "#list_of_Keywords_admin" ).children().length; i++ )
            {
                array_of_keywords.push( $( "#list_of_Keywords_admin>li>p.Keyword_Name" ).get( i ).innerText );
            }
            //TODO ADD Category TO DB WITH KAt ID AND EVERYTHING ELSE
            alert( "YAY\n" + array_of_keywords );
        }
        else
            alert( "Liste leer" );
    } else
        alert( "Eingabefeld leer!" );
} );