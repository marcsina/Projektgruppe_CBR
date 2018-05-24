class Weighted_Words
{
    constructor( word, weight, katID )
    {
        this.word = word;
        this.weight = weight;
        this.katID = katID;
    }
};

class KeywordList
{
    constructor( word, katID )
    {
        this.word = word;
        this.katID = katID;
    }
};

function getKeywordsFromDatabase( database )
{
    if ( database === "" )
    {
        $( "#txtHint" ).html( "Verbindung konnte nicht aufgebaut werden" );
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
            if ( this.readyState == 4 && this.status == 200 )
            {
                $( "#txtHint" ).text( this.responseText );
            }
        };
        xmlhttp.open( "GET", "http://141.99.248.92/Projektgruppe/getKeywords.php", true );
        xmlhttp.send();
    }
}

function isNegate( word )
{
    var array_negate_words = new Array( "nicht", "kein", "keine", "keinem", "keinen", "keiner", "keines", "nichts", "nie" );
    for ( var i = 0; i < array_negate_words.length; i++ )
    {
        if ( word === array_negate_words[i] )
            return true;

    }
    return false;

}

function isReinforcing( word )
{
    var array_reinforing_words = new Array( "absolut", "äußerst", "ausgerpsochen", "besonders", "extrem", "heftig", "höchst", "sehr", "total", "überaus", "ungemein", "ungewöhnlich" );
}
function negateSentence( array, sentenceNumber )
{
    for ( var i = 0; i < array[sentenceNumber].length; i++ )
    {
        array[sentenceNumber][i].weight = -1
    }
}

function createFinalKeywordsArray( array )
{
    var string_keywords = $( "#txtHint" ).text();

    //String bei jedem ; splitten und in array packen
    var array_erste_Stufe = string_keywords.split( ';' );

    //Erste Stufe jeden eintrag bei , splitten und in neuen array packen
    var array_zweite_Stufe = new Array();
    for ( var i = 0; i < array_erste_Stufe.length - 1; i++ )
    {
        array_zweite_Stufe.push( array_erste_Stufe[i].split( ',' ) );
    }

    //Zweite Stufe als Klassen erstellen und in array_keywords speichern
    var array_keywords = new Array();
    for ( var i = 0; i < array_zweite_Stufe.length; i++ )
    {
        array_keywords.push( new KeywordList( array_zweite_Stufe[i][0], array_zweite_Stufe[i][1] ) );
    }

    var final_array = new Array();
    for ( var i = 0; i < array.length; i++ )
    {
        for ( var j = 0; j < array[i].length; j++ )
        {
            for ( var k = 0; k < array_keywords.length; k++ )
            {
                if ( array[i][j].word.toLowerCase() === array_keywords[k].word.toLowerCase() )
                {

                    final_array.push( new Weighted_Words( array[i][j].word, array[i][j].weight, array_keywords[k].katID ) );
                }
            }
        }
    }
    return final_array;
}

$( document ).ready( function ()
{
    getKeywordsFromDatabase( "cbr" );
} );

$( "#berechnen" ).click( function ()
{
    //TODO DELETE IN FINAL
    console.time( 'test' );
    //get text from textarea
    var inputText = $( "#input-textarea" ).text();
    //remove unnecessary whitespace and write everything in lower case
    inputText = inputText.trim();
    //Delete abbrevations consist of maximum 3 letters
    //TODO Error bei words like 'ist' at the end of a sentence
    //inputText = inputText.replace(/[\s][a-zA-Z]{0,3}[.]/gm, "");

    //Remove stopwords
    inputText = inputText.removeStopWords();

    //Split text in sentences
    var sentence_array = inputText.replace( /([.!?,;])\s*(?=[a-zA-Z])/gm, "$1|" ).split( "|" );

     /*
    //stemm sentences and remove punctuations
    var test_array = [];
    words_in_sentences_with_weight_array.forEach( function ( element )
    {
        element = element.replace( /[.!?:;,]/gm, " " );
        test_array.push( stemm( element ) );
    } )*/

    //split sentences in words add standrad weight 0 ... twodimensional arrays
    //Array [sentence][word, weight, katID]
    var words_in_sentences_with_weight_array = new Array( sentence_array.length );
    for ( var i = 0; i < words_in_sentences_with_weight_array.length; i++ )
    {
        words_in_sentences_with_weight_array[i] = sentence_array[i].split( " " );
        for ( var j = 0; j < words_in_sentences_with_weight_array[i].length; j++ )
        {
            words_in_sentences_with_weight_array[i][j] = new Weighted_Words( stemm2( words_in_sentences_with_weight_array[i][j] ), 0, 0 );
        }
    }
  
    //negate whole sentence if sentence is negated
    for ( var i = 0; i < words_in_sentences_with_weight_array.length; i++ )
    {

        for ( var j = 0; j < words_in_sentences_with_weight_array[i].length; j++ )
        {
            if ( isNegate( words_in_sentences_with_weight_array[i][j].word ) )
            {
                negateSentence( words_in_sentences_with_weight_array, i );
                //words_in_sentences_with_weight_array[i][j].weight = -1;
            }
        }
    }

    //delete words from array, if they are not keywords used by CBR
    var final_array = createFinalKeywordsArray( words_in_sentences_with_weight_array );

    ///////TESTAUSGABE
    var output = "";
    for ( var i = 0; i < final_array.length; i++ )
    {
        output = output + "<br>" + i + " || " + final_array[i].word + "  " + final_array[i].weight + " " + final_array[i].katID;

    }

    //$( "#output-textarea" ).html( output );
    //TODO DELETE IN FINAL
    console.timeEnd( 'test' );
} );