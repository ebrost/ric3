
$(function() {
    var Ric = window.Ric || {};

    Ric.searchActionsManager = function(config) {
        var prefix = config.prefix;
        var $formElement = $(config.formElement);
        var $formSubmitElement = $(config.formSubmitElement);
        
        var $activiteElement= $("#SearchActivite");
        var $genreElement= $("#SearchGenre");
        var $genresSelectContainer=$("#genres");
        var $disciplinesSelectContainer=$("#disciplines");
        

        var getCountUrl = config.getCountUrl;
        var getCountNoResponse = config.getCountNoResponse || 'pas de résultat';
        var $countElement = $(config.countElement || '#count');
        var countLoading = config.countLoading || '<i class="fa fa-spinner fa-spin icon-large"></i>';

        var $communeElement = $('#SearchCommune');
        var $communeIdElement = $("#SearchCommuneId");
        var getCommunesUrl = config.getCommunesUrl || jsBase + "/../Communes/autocomplete";
        var $communesRadiusContainer = $("#communes-radius-container");
        var $searchRadius = $("#SearchRadius");
        var $communesRadius = $("#communes-radius");
        var currentCommune = (!$communeElement.val()) ? '' : $communeElement.val();
        var $searchStartDate= $('#SearchStartDateComponent');
        var $searchEndDate= $('#SearchEndDateComponent');

        var getGenresByActiviteIdUrl =config.getGenresByActiviteIdUrl;
        var getDisciplinesListByActiviteIdAndGenreId=config.getDisciplinesListByActiviteIdAndGenreId;
        
        var $tabContainer= $(config.tabContainer || "#tab_recherche"); 
        var $simpleSearchTab=$(config.simpleSearchTab ||"#recherche-simple-tab");
        var $advancedSearchTab=$(config.advancedSearchTab || "#recherche-avancee-tab");
        var $inputsFieldsToShowOnAdvancedSearch=$(config.inputsFieldsToShowOnAdvancedSearch);
        
        
       
        function getCount() {
            $countElement.html(countLoading).fadeIn();
            $.post(getCountUrl, $formElement.serialize(), function(data) {
                var count = data.count, response;
                if (count === 0) {
                    response = getCountNoResponse;
                    $formSubmitElement.fadeOut();
                }
                else {
                    response = count + ' résultat';
                    response += (count > 1) ? 's' : '';
                    $formSubmitElement.fadeIn();
                }
                $countElement.html(response).fadeIn();
            }, 'json');

        }
        
        
        function attachLoadingElementTo(element){
         //   element.after('<img class="loadingImg" src="'+jsRoot+'/img/loader.gif"/>');
            element.after('<i class="fa fa-spinner"></i>');
        }
         function removeLoadingElementFrom(element){
            
            element.next().remove();
        }
        
        function getGenresByActiviteId(){
           // var $activiteElement=$(this);
            
            $genresSelectContainer.fadeOut();
            $disciplinesSelectContainer.fadeOut();
            attachLoadingElementTo($activiteElement);
            $.post(getGenresByActiviteIdUrl,"ajax=true&activiteId="+$activiteElement.val(),function(data){
		var output='';
                if (data && data.length>0){
                    output+='<select id=\"SearchGenre\" class=\"form-control changeListener\" name=\"data[Search][genre]\"><option value="">Tous genres</option>';
                    $.each(data, function() {
			output+=this['name'];
			output+='<option class=\"'+this['class']+'\" value=\"'+this['value']+'\">'+this['name']+'</option>';
                    });
                    output+='</select>';
			
                    
                }
                $genresSelectContainer.fadeIn().html(output);
                removeLoadingElementFrom($activiteElement);
                                        
                
            },'json');
        
        }
        
         function getDisciplinesByActiviteIdAndGenreId(){
             
             console.log($genreElement)
         }

        function setCommunesAutocompletion() {
            $communeElement.autocomplete({
                source: getCommunesUrl,
                minLength: 3,
                select: function(event, ui) {
                    $communeElement.val(ui.item.label);
                    $communeIdElement.val(ui.item.id);
                    $communesRadiusContainer.fadeIn();
                    currentCommune = ui.item.label;
                    getCount();
                    return false;
                },
                focus: function(event, ui) {
                    $communesRadiusContainer.fadeOut();
                }

            }).data("ui-autocomplete")._renderItem = function(ul, item) {

                var hightlightLabel = item.label.replace(new RegExp("(" + this.term + ")", "gi"), '<b>$1</b>');

                return $("<li></li>")
                        .append("<a class=\"communes_autocomplete_label\">" + hightlightLabel + "<span class=\"communes_cp\">(" + item.cp + ")</span></a>")
                        .appendTo(ul);
            };
        }

        function setCommunesNearSlider() {
            $communesRadius.slider({
                range: "max",
                min: 0,
                max: 30,
                step: 5,
                value: $searchRadius.val(),
                slide: function(event, ui) {
                    $searchRadius.val(ui.value).trigger('change');
                }
            });
            
            $searchRadius.val($communesRadius.slider("value"));
            if(!$communeElement.val()) $communesRadiusContainer.hide();
            else{
                $communesRadiusContainer.show();
                $communesRadius.slider('enable');
            }

        }
        
        function resetCommunes(){
                $communeElement.val(null);
		$communeIdElement.val(null);
		$communesRadiusContainer.fadeOut();
		$communesRadius.slider("value",0);
		$searchRadius.val( 0);
            
        }

        function bindEvents() {
           var startDate=$searchStartDate.datepicker({
                language: "fr",
                autoclose:true,
                todayBtn: 'linked',
                todayHighlight: true,
                format:'dd-mm-yyyy',
                startDate:Ric.today
             });
             var endDate=$searchEndDate.datepicker({
                language: "fr",
                autoclose:true,
                todayBtn: 'linked',
                todayHighlight: true,
                format:'dd-mm-yyyy',
                startDate:Ric.today,
               
             }) 
                     
                    startDate.on('changeDate',function(ev){
               
                 if(ev.date>$searchEndDate.datepicker('getDate')){
                     var newDate= new Date(ev.date);
                     newDate.setDate(newDate.getDate());
                     $searchEndDate.datepicker('setDate',newDate);
                 }
             });
             
             endDate.on('changeDate',function(ev){
               console.log('changedate')
                 if(ev.date<$searchStartDate.datepicker('getDate')){
                     var newDate= new Date(ev.date);
                     newDate.setDate(newDate.getDate());
                     $searchStartDate.datepicker('setDate',newDate);
                 }
             });
             
            $formElement.on('change','.changeListener', getCount);
            $communeElement.blur(function(){if($(this).val()!==currentCommune)resetCommunes();});
            $formElement.on('change',"#SearchActivite", getGenresByActiviteId);
            $formElement.on('change',"#SearchGenre", getDisciplinesByActiviteIdAndGenreId);
            $tabContainer.on('shown.bs.tab',$('a[data-toggle="tab"]'),  function (e) {localStorage[prefix+'SelectedTab']=$(e.target).attr('href');});
            $simpleSearchTab.on('click',(function(){$inputsFieldsToShowOnAdvancedSearch.hide();}));
            $advancedSearchTab.on('click',(function(){$inputsFieldsToShowOnAdvancedSearch.show();}));
        }
          
        function setInitialSeachTab(){
           var selectedTab=localStorage[prefix+'SelectedTab'];
           if (selectedTab) $tabContainer.find('a[href="'+selectedTab+'"]').tab('show');
           if (selectedTab==="#recherche-avancee"){
		$inputsFieldsToShowOnAdvancedSearch.show();
            }
            else{
		$inputsFieldsToShowOnAdvancedSearch.hide();
            };
        };

        function init() {
            setInitialSeachTab();
            setCommunesAutocompletion();
            setCommunesNearSlider();
            bindEvents();
        }
        init();
    };


   

});

;
