//	HYPE.documents["Christmaspage"]

(function HYPE_DocumentLoader() {
	var resourcesFolderName = "Christmaspage_Resources";
	var documentName = "Christmaspage";
	var documentLoaderFilename = "christmaspage_hype_generated_script.js";

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
	if(typeof HYPE_124 == "undefined") {
		if(typeof window.HYPE_124_DocumentsToLoad == "undefined") {
			window.HYPE_124_DocumentsToLoad = new Array();
			window.HYPE_124_DocumentsToLoad.push(HYPE_DocumentLoader);

			var headElement = document.getElementsByTagName('head')[0];
			var scriptElement = document.createElement('script');
			scriptElement.type= 'text/javascript';
			scriptElement.src = resourcesFolderName + '/' + 'HYPE.js?hype_version=124';
			headElement.appendChild(scriptElement);
		} else {
			window.HYPE_124_DocumentsToLoad.push(HYPE_DocumentLoader);
		}
		return;
	}
	
	// guard against loading multiple times
	if(HYPE.documents[documentName] != null) {
		return;
	}
	
	var hypeDoc = new HYPE_124();
	
	var attributeTransformerMapping = {b:"i",c:"i",bC:"i",d:"i",aS:"i",M:"i",e:"f",N:"i",f:"d",aT:"i",O:"i",g:"c",aU:"i",P:"i",Q:"i",aV:"i",R:"c",aW:"f",S:"i",aI:"i",T:"i",l:"d",aX:"i",aJ:"i",m:"c",n:"c",aK:"i",aZ:"i",X:"i",A:"c",Y:"i",aL:"i",B:"c",C:"c",D:"c",t:"i",E:"i",G:"c",bA:"c",a:"i",bB:"i"};

var scenes = [{initialValues:{"2":{b:381,z:"1",K:"Solid",c:90,L:"Solid",d:15,aS:6,M:1,bD:"none",N:1,aT:6,O:1,g:"#F0F0F0",aU:6,P:1,aV:6,j:"absolute",k:"div",l:"0deg",m:"#3C3C3C",n:"#F0F0F0",A:"#A0A0A0",B:"#A0A0A0",Z:"break-word",r:"inline",C:"#A0A0A0",aM:"2_hover",D:"#A0A0A0",t:13,F:"center",aA:{type:1,sceneOid:"3",transition:2},G:"#FFFFFF",aP:"pointer",w:"Click to View",x:"visible",I:"Solid",a:574,y:"preserve",J:"Solid"}},sceneIndex:0,timelines:{"2_hover":{framesPerSecond:30,animations:[{f:"2",t:0,d:1,i:"n",e:"#F0F0F0",r:1,s:"#F0F0F0",o:"2"},{f:"2",t:0,d:1,i:"m",e:"#606060",r:1,s:"#3C3C3C",o:"2"},{f:"2",t:0,d:1,i:"l",e:"0deg",r:1,s:"0deg",o:"2"}],identifier:"2_hover",name:"2_hover",duration:1},kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:0}},perspective:"600px",oid:"1",backgroundColor:"#262626",name:"Untitled Scene"},{onSceneAnimationCompleteAction:{type:0},timelines:{"5_hover":{framesPerSecond:30,animations:[{f:"2",t:0,d:1,i:"m",e:"#3F3F3F",r:1,s:"#7C7C7C",o:"5"}],identifier:"5_hover",name:"5_hover",duration:1},"5_pressed":{framesPerSecond:30,animations:[{f:"2",t:0,d:1,i:"m",e:"#373737",r:1,s:"#7C7C7C",o:"5"}],identifier:"5_pressed",name:"5_pressed",duration:1},kTimelineDefaultIdentifier:{framesPerSecond:30,animations:[{t:0,p:1,i:"Video Track",d:10.01,o:"4",f:"2"},{f:"2",t:10,d:1.5,i:"e",e:"1.000000",r:1,s:"0.000000",o:"5"}],identifier:"kTimelineDefaultIdentifier",name:"Main Timeline",duration:11.5}},sceneIndex:1,perspective:"600px",initialValues:{"4":{aR:"0",x:"visible",a:0,bE:[{filename:"chirstmas%20card%20clip.mov"}],b:51,j:"absolute",c:1240,z:"1",aO:"1",d:697.5,k:"video",e:"1.000000",aQ:"0",aH:"1"},"5":{b:765,z:"2",K:"Solid",c:171,L:"Solid",d:15,aS:6,M:1,e:"0.000000",bD:"none",N:1,aT:6,O:1,g:"#F0F0F0",aU:6,P:1,aV:6,j:"absolute",k:"div",l:"0deg",m:"#7C7C7C",n:"#DCDCDC",A:"#A0A0A0",B:"#A0A0A0",Z:"break-word",r:"inline",C:"#A0A0A0",aM:"5_hover",D:"#A0A0A0",aN:"5_pressed",t:13,F:"center",aA:{type:5,goToURL:"http://www.vigorgems.com/",openInNewWindow:false},G:"#000000",aP:"pointer",w:"Go to our homepage",x:"visible",I:"Solid",a:527,y:"preserve",J:"Solid"}},oid:"3",backgroundColor:"#262626",name:"Untitled Scene 2"}];


	
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
	hypeDoc.setMainContentContainerID("christmaspage_hype_container");
	hypeDoc.setResourcesFolderName(resourcesFolderName);
	hypeDoc.setShowHypeBuiltWatermark(0);
	hypeDoc.setShowLoadingPage(false);
	hypeDoc.setDrawSceneBackgrounds(true);
	hypeDoc.setDocumentName(documentName);

	HYPE.documents[documentName] = hypeDoc.API;

	hypeDoc.documentLoad(this.body);
}());

