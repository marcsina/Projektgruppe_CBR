var count_of_Sliders = 0;
var i = 0;

//Update slider when page is loaded, due to the circumstance that forms, are not reseting
updateSlider( $( "#add_new_Category_Slider" ).val(), "add_new_Category_Slider_Value" );

//update new Category Slider
function updateSlider( slideAmount, textField )
{

    $( "#" + textField ).text( "Gewicht: " + Math.round(slideAmount*100)/100 + "%" );
}

//remove category from list
function removeCategoryFromList( name )
{
    $( "#" + name ).remove();
}
//create new items in list
function add_Item_to_Category_list( kategorie_name, sliderValue )
{
    //String for sliderupdate
    var string_1 = "updateSlider( this.value, 'slider_value_" + count_of_Sliders + "')";
    var string_2 = "removeCategoryFromList('li_ID_" + count_of_Sliders + "')";
    $( "#list_of_Category_admin" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Category_Name" ).attr( 'id', "Category_list_name" + count_of_Sliders ).append
                ( "<B>" + kategorie_name + "</B>" )
            ).append
                ( $( '<p>' ).attr( 'id', "slider_value_" + count_of_Sliders ).attr( 'class', "Slider_Value" ).append( "Gewicht: " + Math.round( sliderValue * 100 ) / 100 + "%" ) ).append
            ( $( '<input>' ).attr( 'type', "range" ).attr( 'min', "0" ).attr( 'max', "100" ).attr( 'value', Math.round(sliderValue*100)/100 ).attr( 'class', "slider" ).attr( 'id', "slider" + count_of_Sliders ).attr( 'onchange', string_1 )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++
}

$( "#btn_add_new_Category" ).click( function ( event )
{
    var isAlreadyOnList = false;
    for ( i = 0; i < count_of_Sliders; i++ )
    {
        var string = "Category_list_name" + i;
        if ( $( "#add_new_Category" ).val() === $( "#" + string ).text() )
        {
            isAlreadyOnList = true;
        }

    }
    if ( $( "#add_new_Category" ).val() != "" && isAlreadyOnList === false )
    {
        add_Item_to_Category_list( $( "#add_new_Category" ).val(), $( "#add_new_Category_Slider" ).val() );
    }
}
);
$( "#btn_search_Text" ).click( function ( event )
{
    //TODO 
    var text = $( "#text_admin" ).val();
    var weighted_category_array = extractKeywords( text );
    for ( i = 0; i < weighted_category_array.length; i++ )
    {
        if ( weighted_category_array[i].katName != "" && weighted_category_array[i].weight != "NaN" )
        add_Item_to_Category_list( weighted_category_array[i].katName, weighted_category_array[i].weight*100 );
        var t = 0;
    }
} );

/**
 * 
 * OLD TIMER UPDATE
//update Weight every 100ms
//setInterval( check_Weight, 100 );

//TODO try to find a possibiliyt to create dynamic listener functions for every slider
//update Weight based on slider
function check_Weight()
{
    for ( i = 0; i < count_of_Sliders; i++ )
    {
        var test1 = "slider_value_" + i;
        var test2 = "slider" + i;
        $( "#" + test1 ).text( "Gewicht " + $( "#" + test2 ).val() );
    }
}
**/