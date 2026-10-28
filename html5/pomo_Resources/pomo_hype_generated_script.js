//	HYPE.documents["pomo"]

(function HYPE_DocumentLoader() {
	var resourcesFolderName = "pomo_Resources";
	var documentName = "pomo";
	var documentLoaderFilename = "pomo_hype_generated_script.js";

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

var scenes = [{timelines:{kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{f:"2",t:0,d:1.5,i:"a",e:-210,r:1,s:-700,o:"2"},{f:"2",t:0,d:1.5,i:"a",e:490,r:1,s:980,o:"3"},{f:"2",t:1.5,d:1,i:"e",e:"1.000000",r:1,s:"0.000000",o:"6"},{f:"2",t:1.5,d:1,i:"e",e:"0.300000",r:1,s:"1.000000",o:"3"},{f:"2",t:1.5,d:1,i:"e",e:"0.300000",r:1,s:"1.000000",o:"2"},{f:"2",t:2.2666667,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"11"},{f:"2",t:2.2666667,d:0.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"10"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:2.7666667}},sceneIndex:0,perspective:"600px",oid:"1",initialValues:{"3":{o:"content-box",h:"bg_red_1st.jpg",x:"visible",a:980,q:"100% 100%",b:50,j:"absolute",r:"inline",c:700,k:"div",z:"2",d:350,e:"1.000000"},"8":{o:"content-box",h:"bf_pomo_bottom.png",x:"visible",a:0,q:"100% 100%",b:710,j:"absolute",r:"inline",c:980,k:"div",z:"8",d:10},"4":{o:"content-box",h:"bg_pomo_right.png",x:"visible",a:950,q:"100% 100%",b:0,j:"absolute",r:"inline",c:30,k:"div",z:"4",d:450},"11":{o:"content-box",w:"",h:"bt_pomo_1str.jpg",x:"visible",a:354,q:"100% 100%",b:0,j:"absolute",r:"inline",aA:{goToURL:"#1str",type:5,openInNewWindow:false},k:"div",z:"2",bF:"12",d:300,c:300,aP:"pointer",e:"0.000000"},"9":{o:"content-box",h:"bf_pomo_top.png",x:"visible",a:0,q:"100% 100%",b:24,j:"absolute",r:"inline",c:980,k:"div",z:"6",d:10},"5":{o:"content-box",h:"bg_pomo_left.png",x:"visible",a:0,q:"100% 100%",b:0,j:"absolute",r:"inline",c:30,k:"div",z:"5",d:450},"12":{k:"div",x:"visible",c:654,d:300,z:"7",a:163,j:"absolute",b:416},"6":{o:"content-box",h:"bg_pomo_title.png",x:"hidden",a:178,q:"100% 100%",b:196,j:"absolute",r:"inline",c:623,k:"div",z:"3",d:57,e:"0.000000"},"10":{o:"content-box",h:"bt_pomo_3str.jpg",x:"visible",a:0,q:"100% 100%",b:0,j:"absolute",r:"inline",aA:{goToURL:"#3strs",type:5,openInNewWindow:false},k:"div",z:"1",bF:"12",d:300,c:300,aP:"pointer",e:"0.000000"},"2":{o:"content-box",h:"bg_green_1st.jpg",x:"visible",a:-700,q:"100% 100%",b:50,j:"absolute",r:"inline",c:700,k:"div",z:"1",d:350,e:"1.000000"}},backgroundColor:"#FFFFFF",name:"Main"}];


	
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
	hypeDoc.setMainContentContainerID("pomo_hype_container");
	hypeDoc.setResourcesFolderName(resourcesFolderName);
	hypeDoc.setShowHypeBuiltWatermark(0);
	hypeDoc.setShowLoadingPage(true);
	hypeDoc.setDrawSceneBackgrounds(true);
	hypeDoc.setDocumentName(documentName);

	HYPE.documents[documentName] = hypeDoc.API;

	hypeDoc.documentLoad(this.body);
}());

