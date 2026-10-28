//	HYPE.documents["3stringsbracelet"]

(function HYPE_DocumentLoader() {
	var resourcesFolderName = "3stringsbracelet_Resources";
	var documentName = "3stringsbracelet";
	var documentLoaderFilename = "3stringsbracelet_hype_generated_script.js";

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

var scenes = [{timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:0}},sceneIndex:0,perspective:"600px",oid:"1",initialValues:{"2":{o:"content-box",h:"bg_3str_ita.jpg",x:"visible",a:60,q:"100% 100%",b:0,j:"absolute",r:"inline",c:640,k:"div",z:"1",d:425},"3":{o:"content-box",h:"Italy.gif",x:"visible",a:181,q:"100% 100%",b:486,j:"absolute",r:"inline",c:48,k:"div",z:"2",d:48},"4":{o:"content-box",h:"Germany.gif",x:"visible",a:245,q:"100% 100%",b:486,j:"absolute",r:"inline",aA:{type:1,sceneOid:"5",transition:2},k:"div",z:"3",d:48,c:48,aP:"pointer"}},backgroundColor:"#FFFFFF",name:"italy"},{timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:0}},sceneIndex:1,perspective:"600px",oid:"5",initialValues:{"6":{o:"content-box",h:"Italy.gif",x:"visible",a:181,q:"100% 100%",b:486,j:"absolute",r:"inline",aA:{type:1,sceneOid:"1",transition:2},k:"div",z:"2",d:48,c:48,aP:"pointer"},"7":{o:"content-box",h:"Germany.gif",x:"visible",a:245,q:"100% 100%",b:486,j:"absolute",r:"inline",aA:{type:1,transition:2,sceneOid:"5"},k:"div",z:"3",d:48,c:48,aP:"pointer"},"8":{o:"content-box",h:"bg_3str_ger.jpg",x:"visible",a:81,q:"100% 100%",b:0,j:"absolute",r:"inline",c:596.61017,k:"div",z:"1",d:550}},backgroundColor:"#FFFFFF",name:"german"}];


	
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
	hypeDoc.setMainContentContainerID("3stringsbracelet_hype_container");
	hypeDoc.setResourcesFolderName(resourcesFolderName);
	hypeDoc.setShowHypeBuiltWatermark(0);
	hypeDoc.setShowLoadingPage(false);
	hypeDoc.setDrawSceneBackgrounds(true);
	hypeDoc.setDocumentName(documentName);

	HYPE.documents[documentName] = hypeDoc.API;

	hypeDoc.documentLoad(this.body);
}());

