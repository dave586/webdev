/* global $ */
     
     //this js helps with the search function not using php, but the web service that is build

  //starts the function when DOM is loaded
  $(document).ready( function() {
    //search handler
    $('.ui.search').search({
        //the min characters to start the search
         minCharacters : 2,
         //search only the title field
        searchFields : ['title'],
          //search the beginning of the text
            searchFullText: false,
            
                  //adding a on select event that goes to the single painting page with the target's info(title)
         onSelect : function(event) {
        window.location.href="single-painting.php?PaintingID="+event.PaintingID;
    },
        //getting the json from web service
         apiSettings: {
       url: "service-painting.php?search={query}"
    },
    //the fields used in selecting the right search string 
    fields: {
      title   : 'Title',
      description: 'Name'

    }
    });  
        //search the string when press enter
    $('.ui.search').keypress(function(e){
        
        if ( e.keyCode == 13){
         var inputStr= e.target.value;
         //console.log(inputStr);
         window.location.href="browse-paintings.php?search="+e.target.value;
        }else{
        }
      
      });
  } );
 