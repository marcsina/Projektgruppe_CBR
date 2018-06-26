var count_of_Sliders = 0;
var i = 0;
var Categories_From_DB = new Array();
var Keywords_From_DB = new Array();
var Categories_Name_Array = new Array();
var Keywords_Name_Array = new Array();
var Edit_Case_Array = new Array();
var Edit_Category_Array = new Array();
var Cases_From_DB = new Array();
var Cases_Name_Array = new Array();
var Case_To_Delete_Array = new Array();

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

class Case_Base
{
    constructor( id, name )
    {
        this.id = id;
        this.name = name;
    }

}
class Case
{
    constructor( caseId, caseName, katName, katId, katValue )
    {
        this.caseId = caseId;
        this.katName = katName;
        this.caseName = caseName;
        this.katValue = katValue;
        this.katId = katId;
    }
}

class Symptom
{
    constructor( ICFid, name )
    {
        this.ICFid = ICFid;
        this.name = name;
    }
}
//Load Stuff when Website is opened
$( document ).ready( function ()
{
    //get Keywords and store them in hidden fields
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );
    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
    getCasesFromDatabase( "dementia", Cases_From_DB, Cases_Name_Array );
} );
//Activate autocomplete at inputfields by ID
autocomplete( document.getElementById( "add_new_Category" ), Categories_Name_Array );
autocomplete( document.getElementById( "add_new_Category_Category_Name" ), Categories_Name_Array );
autocomplete( document.getElementById( "edit_Category_Name" ), Categories_Name_Array );
autocomplete( document.getElementById( "delete_Case_Name" ), Cases_Name_Array );

//Update slider when page is loaded, due to the circumstance that forms, are not reseting
updateSlider( $( "#add_new_Category_Slider" ).val(), "add_new_Category_Slider_Value" );

//switch between tabs
$( ".nav-tabs a" ).click( function () { $( this ).tab( 'show' ); } );

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

                Categories_From_DB = new Array();
                Categories_Name_Array = new Array();
                for ( i = 0; i < array2.length; i++ )
                {
                    Categories_From_DB.push( new Category_Word_ID( array2[i][0], array2[i][1] ) );
                    Categories_Name_Array.push( array2[i][1] );
                }

                autocomplete( document.getElementById( "add_new_Category" ), Categories_Name_Array );
                autocomplete( document.getElementById( "add_new_Category_Category_Name" ), Categories_Name_Array );
                autocomplete( document.getElementById( "edit_Category_Name" ), Categories_Name_Array );
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getCategories.php", false );
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
                Keywords_From_DB = new Array();
                Keywords_Name_Array = new Array();
                //Zweite Stufe als Klassen erstellen und in array_keywords speichern
                var array_keywords = new Array();
                for ( i = 0; i < array_zweite_Stufe.length; i++ )
                {
                    Keywords_From_DB.push( new KeywordList( array_zweite_Stufe[i][0].toLowerCase(), array_zweite_Stufe[i][1], array_zweite_Stufe[i][2] ) );
                    Keywords_Name_Array.push( array_zweite_Stufe[i][0].toLowerCase() );
                }
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getKeywords.php", false );
        xmlhttp.send();
    }
}

function getCasesFromDatabase( database, givenArray, givenArray2 )
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
                Cases_From_DB = new Array();
                Cases_Name_Array = new Array();
                //Zweite Stufe als Klassen erstellen und in array_keywords speichern
                var array_keywords = new Array();
                for ( i = 0; i < array_zweite_Stufe.length; i++ )
                {
                    Cases_From_DB.push( new Case_Base( array_zweite_Stufe[i][0], array_zweite_Stufe[i][1] ) );
                    Cases_Name_Array.push( array_zweite_Stufe[i][1] );
                }

                autocomplete( document.getElementById( "delete_Case_Name" ), Cases_Name_Array );
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/php/include/getCases.php", false );
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

///STUFF FOR ADD CATEGORY
/////////////////////////
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
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
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
//Search for keywords in text
$( "#btn_search_Text" ).click( function ( event )
{
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
    var text = $( "#text_admin" ).text();
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



    //-------------------------Show detected Words in HTML------------------------------------------
    //split the Text
    var everyWordArray = $( "#text_admin" ).text().split( /\s/ );

    var showEveryWord = "";
    var checked = 0;

    var keyWords = createKeywords();

    //Check every Word in the Text
    for ( i = 0; i < everyWordArray.length; i++ )
    {
        everyWordArray[i] = everyWordArray[i].replace( /[.!?;:,+0-9]/gm, "" ).replace( /\-/gm, " " );

        //Stemm the word 
        //variable so that it wont check twice and wont save the word twice
        checked = 0;

        //check every KeyWord
        for ( j = 0; j < keyWords.length; j++ )
        {
            //if word = keyword highlight it
            if ( stemm2( everyWordArray[i].toLowerCase() ) === keyWords[j].word && checked === 0 )
            {
                //make it bold and blue
                showEveryWord = showEveryWord + " " + "<b><font color='blue'>" + everyWordArray[i] + "</font></b>";

                checked = 1;
            }

        }

        //if the word was not found in the array make it normal
        if ( checked === 0 )
        {
            //make it normal
            showEveryWord = showEveryWord + " " + everyWordArray[i];
        }

    }

    $( "#text_admin" ).html( showEveryWord );
    //----------------------------------------------------------------------------------

} );
//Btn to add Case to DB
$( "#btn_add_Case_to_DataBase" ).click( function ( event )
{
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
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
                console.log( "Name: " + array_CategoryName[i] + " ID: " + array_CategroyID[i] + " Wert: " + array_CategoryValue[i] + "\n" );
            }
            $.post( 'php/include/AddCaseAdmin.php', {
                caseName: $( "#add_New_Case_Name" ).val(),
                name: JSON.stringify( array_CategoryName ),
                id: JSON.stringify( array_CategroyID ),
                value: JSON.stringify( array_CategoryValue )
            } );

        }
        else
            alert( "Liste leer" );
    }
    else
        alert( "Eingabefeld leer!" );
} );
//Show all Categories
$( "#btn_add_all_Category" ).click( function ( event )
{
    for ( i = 0; i < Categories_Name_Array.length; i++ )
    {
        add_Item_to_Category_list( Categories_Name_Array[i], 0 );
    }
} );

//STUFF FOR ADD KEYWORD
///////////////////////
$( "#btn_add_new_Keyword" ).click( function ( event )
{
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
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
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );
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
                array_of_keywords.push( stemm2( $( "#list_of_Keywords_admin>li>p.Keyword_Name" ).get( i ).innerText ) );
            }
            $.post( 'php/include/AddNewKategorie.php', {
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

//STUFF FOR EDIT CASE
//////////////////////
//create new items in list for case edit
function add_Item_to_Category_list_case_edit( kategorie_name, sliderValue )
{
    //String for sliderupdate
    var string_1 = "updateSlider( this.value, 'slider_value_edit_" + count_of_Sliders + "')";
    //Command for deleting list item
    var string_2 = "removeFromList('li_ID_edit" + count_of_Sliders + "')";
    //ADD BOX AROUND LIST
    if ( $( "#list_of_Keywords_case_edit" ).children().length === 0 )
    {
        $( "#list_of_Keywords_case_edit" ).addClass( "list_admin" );
    }
    //CREATE NEW LIST ITEM WITH SLIDER ETC.
    $( "#list_of_Keywords_case_edit" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_edit" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Category_Name" ).attr( 'id', "Category_list_name_edit" + count_of_Sliders ).append
                ( "<B>" + kategorie_name + "</B>" )
            ).append
            ( $( '<p>' ).attr( 'id', "slider_value_edit_" + count_of_Sliders ).attr( 'class', "Slider_Value" ).append( "Gewicht: " + Math.round( sliderValue * 100 ) + "%" ) ).append
            ( $( '<input>' ).attr( 'type', "range" ).attr( 'min', "0" ).attr( 'max', "100" ).attr( 'value', Math.round( sliderValue * 100 ) ).attr( 'class', "slider" ).attr( 'id', "slider" + count_of_Sliders ).attr( 'onchange', string_1 ).attr( 'step', "10" )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category_edit" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++;
}
//------------Edit Case--------------------------------------------
$( "#btn_load_case" ).click( function ( event ) 
{

    Edit_Case_Array = [];

    $.post( 'php/include/getCaseAdmin.php', {
        caseName: $( "#edit_Case_Name" ).val()
    } ).done( function ( data )
    {

        var array_erster_split = data.split( ";" );

        var array_zweiter_split = new Array( array_erster_split.length );
        for ( i = 0; i < array_erster_split.length - 1; i++ )
        {
            array_zweiter_split[i] = array_erster_split[i].split( "," );
            add_Item_to_Category_list_case_edit( array_zweiter_split[i][2], array_zweiter_split[i][4] );
            Edit_Case_Array.push( new Case( array_zweiter_split[i][0], array_zweiter_split[i][1], array_zweiter_split[i][2], array_zweiter_split[i][3], array_zweiter_split[i][4] ) );
        }

        //make the div visible
        document.getElementById( "div_edit_case" ).style.visibility = "visible";

    } );
} );


$( "#btn_edit_case_save_to_db" ).click( function ( event )
{

    //Array Which contains Categoryname + ID
    var array_of_categories = new Array();
    var array_CategoryName = new Array();
    var array_CategroyID = new Array();
    var array_CategoryValue = new Array();
    for ( i = 0; i < $( "#list_of_Keywords_case_edit" ).children().length; i++ )
    {
        var c = i;
        var string = $( "#list_of_Keywords_case_edit>li>p.Category_Name" ).get( i ).innerText;
        var sliderValue = $( "#list_of_Keywords_case_edit>li>input.slider" ).get( i ).value;

        //array_CategoryName.push(string);
        array_CategroyID.push( searchForIDOfCategory( string, Categories_From_DB ) );
        array_CategoryValue.push( sliderValue / 100 );
        i = c;
    }

    var result = $.post( 'php/include/EditCaseAdmin.php', {
        caseID: Edit_Case_Array[0].caseId,
        id: JSON.stringify( array_CategroyID ),
        value: JSON.stringify( array_CategoryValue )
    } );
} );
//-------------------------------------------------------------------

//----------------------Edit Category--------------------------------
$( "#btn_load_Category" ).click( function ( event )
{
    //reset
    Edit_Category_Array = [];
    $( "#list_of_symptoms_category_edit" ).empty();

    $.post( 'php/include/getCategoryAdmin.php', {
        categoryName: $( "#edit_Category_Name" ).val()
    } ).done( function ( data )
    {

        var array_erster_split = data.split( ";" );

        var array_zweiter_split = new Array( array_erster_split.length );
        for ( i = 0; i < array_erster_split.length - 1; i++ )
        {
            array_zweiter_split[i] = array_erster_split[i].split( "," );
            add_Item_to_Category_list_category_edit( array_zweiter_split[i][1] );
            Edit_Category_Array.push( new Symptom( array_zweiter_split[i][0], array_zweiter_split[i][1] ) );
        }

        //make the div visible
        document.getElementById( "div_edit_category" ).style.visibility = "visible";

    } );


} );
$( "#btn_edit_category_save_to_db" ).click( function ( event )
{
    var symptom_array = new Array();

    if ( $( "#list_of_symptoms_category_edit" ).children().length > 0 )
    {
        var array_of_keywords = new Array();
        for ( i = 0; i < $( "#list_of_symptoms_category_edit" ).children().length; i++ )
        {
            symptom_array.push( stemm2( $( "#list_of_symptoms_category_edit>li>p.Category_Name_Edit" ).get( i ).innerText ) );
        }
        $.post( 'php/include/EditCategoryAdmin.php', {
            symptomname: JSON.stringify( symptom_array ),
            ICFid: Edit_Category_Array[0].ICFid
        } );

        //TODO ADD Category TO DB WITH KAt ID AND EVERYTHING ELSE
        alert( "YAY\n" + array_of_keywords );
    }

} );

$( "#btn_add_new_symptom" ).click( function ( event )
{
    getCategoriesFromDatabase( "dementia", Categories_From_DB, Categories_Name_Array );

    getKeywordsFromDatabase2( "dementia", Keywords_From_DB, Keywords_Name_Array );

    var isAlreadyOnList = false;
    for ( i = 0; i < count_of_Sliders; i++ )
    {
        var string = "Category_list_name_edit" + i;
        if ( $( "#add_new_symptom" ).val() === $( "#" + string ).text() )
        {
            isAlreadyOnList = true;
        }

    }
    if ( $( "#add_new_symptom" ).val() !== "" )
    {
        if ( isAlreadyOnList === false )
            add_Item_to_Category_list_category_edit( $( "#add_new_symptom" ).val() );
        else
            alert( "Keyword schon auf der Liste" );
    } else
        alert( "Eingabefeld leer!" );


} );

function add_Item_to_Category_list_category_edit( kategorie_name )
{
    //Command for deleting list item
    var string_2 = "removeFromList('li_ID_edit" + count_of_Sliders + "')";
    //ADD BOX AROUND LIST
    if ( $( "#list_of_symptoms_category_edit" ).children().length === 0 )
    {
        $( "#list_of_symptoms_category_edit" ).addClass( "list_admin" );
    }
    //CREATE NEW LIST ITEM WITH SLIDER ETC.
    $( "#list_of_symptoms_category_edit" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_edit" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Category_Name_Edit" ).attr( 'id', "Category_list_name_edit" + count_of_Sliders ).append
                ( "<B>" + kategorie_name + "</B>" )
            ).append
            ( $( '<button>' ).attr( 'id', "btn_delete_Category_edit" + count_of_Sliders ).attr( 'class', "btn" ).attr( 'class', "btn-primary" ).attr( 'onclick', string_2 ).append( "Kategorie löschen" ) ) );
    count_of_Sliders++;
}

//-------------------------------------------------------------------

//------------------Delete Case-------------------
$( "#btn_load_case_in_delete" ).click( function ( event ) 
{
    Case_To_Delete_Array = [];
    $.post( 'php/include/getCaseAdmin.php', {
        caseName: $( "#delete_Case_Name" ).val()
    } ).done( function ( data )
    {

        var array_erster_split = data.split( ";" );

        var array_zweiter_split = new Array( array_erster_split.length );
        for ( i = 0; i < array_erster_split.length - 1; i++ )
        {
            array_zweiter_split[i] = array_erster_split[i].split( "," );
            add_Item_to_Category_list_case_delete( array_zweiter_split[i][2], array_zweiter_split[i][4] );

            Case_To_Delete_Array.push( new Case( array_zweiter_split[i][0], array_zweiter_split[i][1], array_zweiter_split[i][2], array_zweiter_split[i][3], array_zweiter_split[i][4] ) );
        }

        //make the div visible
        document.getElementById( "div_delete_case" ).style.visibility = "visible";

    } );
} );

function add_Item_to_Category_list_case_delete( kategorie_name, sliderValue )
{
    //ADD BOX AROUND LIST
    if ( $( "#list_of_case_delete" ).children().length === 0 )
    {
        $( "#list_of_case_delete" ).addClass( "list_admin" );
    }
    //CREATE NEW LIST ITEM WITH SLIDER ETC.
    $( "#list_of_case_delete" ).append
        (
        $( '<li>' ).attr( 'id', "li_ID_edit" + count_of_Sliders ).append
            ( $( '<p>' ).attr( 'class', "Category_Name" ).attr( 'id', "Case_list_name_edit" + count_of_Sliders ).append
                ( "<B>" + kategorie_name + "</B>" )
            ).append
            ( $( '<p>' ).attr( 'id', "slider_value_edit_" + count_of_Sliders ).attr( 'class', "Slider_Value" ).append( "Gewicht: " + Math.round( sliderValue ) + "%" ) ).append
            ( $( '<input>' ).attr( 'type', "range" ).attr( 'min', "0" ).attr( 'max', "100" ).attr( 'value', Math.round( sliderValue ) ).attr( 'class', "slider" ).attr( 'id', "slider" + count_of_Sliders ).attr( 'step', "10" ).attr('disabled', "true")
            )
        );
    count_of_Sliders++;
}

$( "#btn_delet_case_from_db" ).click( function ( event )
{
    $.post( 'php/include/DeleteCaseAdmin.php', {
        CaseID: Case_To_Delete_Array[0].caseId
    } );
} );