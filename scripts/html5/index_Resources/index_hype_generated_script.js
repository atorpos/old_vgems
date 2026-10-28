//	HYPE.documents["index"]

(function HYPE_DocumentLoader() {
	var resourcesFolderName = "index_Resources";
	var documentName = "index";
	var documentLoaderFilename = "index_hype_generated_script.js";

	// find the URL for this script's absolute path and set as the resourceFolderName
	try {
		var scripts = document.getElementsByTagName('script');
		for(var i = 0; i < scripts.length; i++) {
			var scriptSrc = scripts[i].src;
			if(scriptSrc != null && scriptSrc.indexOf(documentLoaderFilename) != -1) {
				resourcesFolderName = scriptSrc.substr(0, scriptSrc.lastIndexOf("/"));
				break;
			}
		}
	} catch(err) {	}

	// Legacy support
	if (typeof window.HYPE_DocumentsToLoad == "undefined") {
		window.HYPE_DocumentsToLoad = new Array();
	}
 
	// load HYPE.js if it hasn't been loaded yet
	if(typeof HYPE_100 == "undefined") {
		if(typeof window.HYPE_100_DocumentsToLoad == "undefined") {
			window.HYPE_100_DocumentsToLoad = new Array();
			window.HYPE_100_DocumentsToLoad.push(HYPE_DocumentLoader);

			var headElement = document.getElementsByTagName('head')[0];
			var scriptElement = document.createElement('script');
			scriptElement.type= 'text/javascript';
			scriptElement.src = resourcesFolderName + '/' + 'HYPE.js?hype_version=100';
			headElement.appendChild(scriptElement);
		} else {
			window.HYPE_100_DocumentsToLoad.push(HYPE_DocumentLoader);
		}
		return;
	}
	
	var hypeDoc = new HYPE_100();
	
	var attributeTransformerMapping = {b:"i",c:"i",bC:"i",aS:"i",d:"i",M:"i",e:"f",N:"i",f:"d",aT:"i",O:"i",g:"c",aU:"i",P:"i",Q:"i",aV:"i",R:"c",aW:"f",aI:"i",S:"i",T:"i",l:"d",aX:"i",aJ:"i",m:"c",n:"c",aK:"i",X:"i",aZ:"i",A:"c",Y:"i",aL:"i",B:"c",C:"c",D:"c",t:"i",E:"i",G:"c",bA:"c",a:"i",bB:"i"};

var scenes = [{timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{f:"2",t:0,d:2.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"5"},{f:"2",t:2.5,d:2.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"6"},{f:"2",t:4,d:2.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"7"},{f:"2",t:7,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"8"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:7.5}},sceneIndex:0,perspective:"600px",oid:"1",initialValues:{"8":{o:"content-box",h:"button_index_explo.jpg",x:"visible",a:440,q:"100% 100%",b:362,j:"absolute",r:"inline",aA:{type:5,goToURL:"http://www.vigorgems.com/bracelet/",openInNewWindow:false},k:"div",z:"4",d:60,c:120,aP:"pointer",e:"0.000000"},"6":{o:"content-box",h:"bg_index_colsubtit.png",x:"visible",a:100,q:"100% 100%",b:116,j:"absolute",r:"inline",c:800,k:"div",z:"2",d:160,e:"0.000000"},"7":{o:"content-box",h:"bg_index_colimg0.jpg",x:"visible",a:100,q:"100% 100%",b:208,j:"absolute",r:"inline",c:800,k:"div",z:"1",d:392,e:"0.000000"},"5":{o:"content-box",h:"bg_index_coltit.png",x:"visible",a:200,q:"100% 100%",b:0,j:"absolute",r:"inline",c:600,k:"div",z:"3",d:100,e:"0.000000"}},backgroundColor:"#FFFFFF",name:"Untitled Scene"}];


	
	var javascripts = [];


	
	var Custom = {};
	var javascriptMapping = {};
	for(var i = 0; i < javascripts.length; i++) {
		try {
			javascriptMapping[javascripts[i].identifier] = javascripts[i].name;
			eval("Custom." + javascripts[i].name + " = " + javascripts[i].source);
		} catch (e) {
			hypeDoc.log(e);
			Custom[javascripts[i].name] = (function () {});
		}
	}
	
	hypeDoc.setAttributeTransformerMapping(attributeTransformerMapping);
	hypeDoc.setScenes(scenes);
	hypeDoc.setJavascriptMapping(javascriptMapping);
	hypeDoc.Custom = Custom;
	hypeDoc.setCurrentSceneIndex(0);
	hypeDoc.setMainContentContainerID("index_hype_container");
	hypeDoc.setResourcesFolderName(resourcesFolderName);
	hypeDoc.setShowHypeBuiltWatermark(0);
	hypeDoc.setShowLoadingPage(false);
	hypeDoc.setDrawSceneBackgrounds(true);
	hypeDoc.setDocumentName(documentName);

	HYPE.documents[documentName] = hypeDoc.API;

	hypeDoc.documentLoad(this.body);
}());

