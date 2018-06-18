var count_of_Sliders = 0;
var i = 0;
var Categories_From_DB = new Array();
var Keywords_From_DB = new Array();
var Categories_Name_Array = new Array();
var Keywords_Name_Array = new Array();

//Classes
class Category_Word_ID
{
    constructor( id, name, value )
    {
        this.id = id;
        this.name = name;
        this.value = value;
    }
}
//Update slider when page is loaded, due to the circumstance that forms, are not reseting
updateSlider( $( "#add_new_Category_Slider" ).val(), "add_new_Category_Slider_Value" );


$( document ).ready( function ()
{
    //get Keywords and store them in hidden fields
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
} );
//Activate autocomplete at inputfields by ID
autocomplete( document.getElementById( "add_new_Category" ), Categories_Name_Array );
autocomplete( document.getElementById( "add_new_Category_Category_Name" ), Categories_Name_Array );

//Get Categories from DB"
function getCategoriesFromDatabase( database, array, array_Name )
{
    if ( database === "" )
    {
        return;
    } else
    {
        if ( window.XMLHttpRequest )
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
        }
        xmlhttp.onreadystatechange = function ()
        {
            if ( this.readyState === 4 && this.status === 200 )
            {
                var array1 = this.responseText.split( ";" );
                var array2 = new Array();
                for ( i = 0; i < array1.length - 1; i++ )
                {
                    array2.push( array1[i].split( "," ) );
                }
                for ( i = 0; i < array2.length; i++ )
                {
                    array.push( new Category_Word_ID( array2[i][0], array2[i][1] ) );
                    array_Name.push( array2[i][1] );
                }
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getCategories.php", true );
        xmlhttp.send();
    }
}

//Get Keywords From DB
function getKeywordsFromDatabase2( database, givenArray, givenArray2 )
{
    if ( database === "" )
    {
        return;
    } else
    {
        if ( window.XMLHttpRequest )
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
        }
        xmlhttp.onreadystatechange = function ()
        {
            if ( this.readyState === 4 && this.status === 200 )
            {
                //String bei jedem ; splitten und in array packen
                var array_erste_Stufe = this.responseText.split( ';' );

                //Erste Stufe jeden eintrag bei , splitten und in neuen array packen
                var array_zweite_Stufe = new Array();
                for ( i = 0; i < array_erste_Stufe.length - 1; i++ )
                {
                    array_zweite_Stufe.push( array_erste_Stufe[i].split( ',' ) );
                }

                //Zweite Stufe als Klassen erstellen und in array_keywords speichern
                var array_keywords = new Array();
                for ( i = 0; i < array_zweite_Stufe.length; i++ )
                {
                    givenArray.push( new KeywordList( array_zweite_Stufe[i][0].toLowerCase(), array_zweite_Stufe[i][1], array_zweite_Stufe[i][2] ) );
                    givenArray2.push( array_zweite_Stufe[i][0].toLowerCase() );
                }
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getKeywords.php", true );
        xmlhttp.send();
    }
}

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
            ( $( '<input>' ).attr( 'type', "range" ).attr( 'min', "0" ).attr( 'max', "100" ).attr( 'value', Math.round( sliderValue * 100 ) / 100 ).attr( 'class', "slider" ).attr( 'id', "slider" + count_of_Sliders ).attr( 'onchange', string_1 ).attr( 'step', "10" )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++;
}

//If Category already on List update slider Value to Given
function add_Item_to_Category_list_AREADY_THERE( kategorie_name, sliderValue, sliderID )
{
    var string1 = "slider_value_" + sliderID;
    $( "#" + string1 ).text( "Gewicht: " + Math.round( sliderValue * 100 ) / 100 + "%" );
    var string2 = "slider" + sliderID;
    $( "#" + string2 ).val( sliderValue );
}

//Add things to list 
$( "#btn_add_new_Category" ).click( function ( event )
{
    var not_in_list = true;
    //Check if entry is empty
    if ( $( "#add_new_Category" ).val() !== "" )
    {
        //check if word is valid category
        if ( !checkIfGivenWordIsInDB( $( "#add_new_Category" ).val(), Categories_Name_Array ) )
        {
            alert( "Kategorie nicht vorhanden" );

        } else
        {
            //check if word is already in List
            for ( i = 0; i < count_of_Sliders; i++ )
            {
                var string = "Category_list_name" + i;
                if ( $( "#add_new_Category" ).val() === $( "#" + string ).text() )
                {
                    //is in list--> update it
                    add_Item_to_Category_list_AREADY_THERE( $( "#add_new_Category" ).val(), $( "#add_new_Category_Slider" ).val(), i );
                    not_in_list = false;
                }
            }
            //not in list--> put it there
            if ( not_in_list === true )
            {
                add_Item_to_Category_list( $( "#add_new_Category" ).val(), $( "#add_new_Category_Slider" ).val() );
            }
        }

    }
    else
    {
        alert( "Eingabefeld leer!" );
    }

}
);
//check if Given Word is in Given Array
function checkIfGivenWordIsInDB( wordToCheck, arrayOfDBWords )
{
    for ( i = 0; i < arrayOfDBWords.length; i++ )
    {
        if ( wordToCheck === arrayOfDBWords[i] )
        {
            return true;
        }
    }
    return false;
}
//Search for keywords in text
$( "#btn_search_Text" ).click( function ( event )
{
    var text = $( "#text_admin" ).val();
    var weighted_category_array = extractKeywords( text );
    for ( i = 0; i < weighted_category_array.length; i++ )
    {
        if ( weighted_category_array[i].katName !== "" && weighted_category_array[i].weight !== "NaN" )
        {
            var not_in_list = true;
            for ( var j = 0; j < count_of_Sliders; j++ )
            {
                var string = "Category_list_name" + j;
                if ( weighted_category_array[i].katName === $( "#" + string ).text() )
                {
                    add_Item_to_Category_list_AREADY_THERE( weighted_category_array[i].katName, weighted_category_array[i].weight * 100, j );
                    not_in_list = false;
                }
            }
            if ( not_in_list === true )
            {
                add_Item_to_Category_list( weighted_category_array[i].katName, weighted_category_array[i].weight * 100 );
            }
        }
    }
} );

$( "#btn_add_Case_to_DataBase" ).click( function ( event )
{

    if ( $( "#add_New_Case_Name" ).val() !== "" )
    {
        if ( $( "#list_of_Category_admin" ).children().length > 0 )
        {
            //Array Which contains Categoryname + ID
            var array_of_categories = new Array();
            var array_CategoryName = new Array();
            var array_CategroyID = new Array();
            var array_CategoryValue = new Array();
            console.log( $( "#list_of_Category_admin" ).children().length );
            for ( i = 0; i < $( "#list_of_Category_admin" ).children().length; i++ )
            {
                var c = i;
                var string = $( "#list_of_Category_admin>li>p.Category_Name" ).get( i ).innerText;
                var sliderValue = $( "#list_of_Category_admin>li>input.slider" ).get( i ).value;
                array_of_categories.push( new Category_Word_ID( searchForIDOfCategory( string, Categories_From_DB ), string, sliderValue ) );

                array_CategoryName.push( string );
                array_CategroyID.push( searchForIDOfCategory( string, Categories_From_DB ) );
                array_CategoryValue.push( sliderValue );
                i = c;
            }
            for ( i = 0; i < array_CategoryName.length; i++ )
            {
                console.log( "Name: " + array_CategoryName[i] + " ID: " + array_CategroyID[i] + " Wert: " + array_CategoryValue[i]+"\n" );
            }
            $.post( 'include/AddCaseAdmin.php', {
                caseName: $( "#add_New_Case_Name" ).val(),
                name: JSON.stringify(array_CategoryName),
                id: JSON.stringify(array_CategroyID),
                value: JSON.stringify(array_CategoryValue)
            } );
            
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
    if ( $( "#add_new_Keyword" ).val() !== "" )
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
    count_of_Sliders++;
}
//Search For ID OF Category
function searchForIDOfCategory( word, givenArray )
{
    var id = -1;
    for ( i = 0; i < givenArray.length; i++ )
    {
        if ( word === givenArray[i].name )
            return givenArray[i].id;
    }
    return id;
}
//Checks if given KatName is already in DB
function checkIFCategoryalreadyExists( katName )
{
    for ( i = 0; i < Categories_Name_Array.length; i++ )
    {
        if ( Categories_Name_Array[i] === katName )
            return true;
    }
    return false;
}
//CLICKING BUTTON TO ADD KATEGORIE TO DB
$( "#btn_add_Category_to_DataBase" ).click( function ( event )
{
    if ( $( "#add_new_Category_Category_Name" ).val() !== "" )
    {
        //update keywords
        getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );
        if ( checkIFCategoryalreadyExists( $( "#add_new_Category_Category_Name" ).val() ) )
        {
            //TODO update einbinden
            alert( "Kategorie exisitiert bereits!" );
        }
        else if ( $( "#list_of_Keywords_admin" ).children().length > 0 )
        {
            var array_of_keywords = new Array();
            for ( i = 0; i < $( "#list_of_Keywords_admin" ).children().length; i++ )
            {
                array_of_keywords.push( stemm2($( "#list_of_Keywords_admin>li>p.Keyword_Name" ).get( i ).innerText) );
            }
            $.post( 'include/AddNewKategorie.php', {
                katName: $( "#add_new_Category_Category_Name" ).val(),
                keywords: JSON.stringify( array_of_keywords )
            } );

            //TODO ADD Category TO DB WITH KAt ID AND EVERYTHING ELSE
            alert( "YAY\n" + array_of_keywords );
        }
        else
            alert( "Liste leer" );
    } else
        alert( "Eingabefeld leer!" );
} );