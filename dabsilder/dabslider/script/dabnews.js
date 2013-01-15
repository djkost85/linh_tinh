var dabnews=new Class({initialize:function(slideItem){
	this.options=Object.extend({
		outerContainer:null,
		innerContainer:null,
		elements:null,
		navigation:{
			forward:null,
			back:null,
			container:null,
			elements:null,
			outer:null,
			visibleItems:0
			},
		slideType:0,
		orientation:1,
		slideTime:3000,
		duration:600,
		tooltips:0,
		autoslide:1,
		navInfo:null,
		navLinks:null
		},
		slideItem||{});
		this.navElements=$(this.options.navigation.container).getElements(this.options.navigation.elements);
		this.navScroll=new Fx.Scroll(this.options.navigation.outer,{
			wait:false,
			duration:800,
			transition:Fx.Transitions.Quad.easeInOut
			});
		this.correction=Math.round(this.options.navigation.visibleItems/2.00001);
		this.start();
		},start:function(){
			this.currentElement=0;
			this.direction=1;
			this.elements=$(this.options.innerContainer).getElements(this.options.elements);
			this.showEffect={};
			this.hideEffect={};
			this.firstRun={};
			if(this.options.slideType!==0){
				if(this.options.orientation==1){
					this.showEffect.left=[1200,0];
					this.hideEffect.left=[0,1200];
					this.firstRun.left=1200;
					}
				else{
					this.showEffect.top=[400,0];
					this.hideEffect.top=[0,400];
					this.firstRun.top=400;
					}
				}
			if(this.options.slideType!==1){
				this.showEffect.opacity=[0,1];
				this.hideEffect.opacity=[1,0];
				this.firstRun.opacity=0;
				}
			this.elements.each(function(navigationItem,slideItem){
				navigationItem.setStyles({display:"block",position:"absolute",top:0,left:0,"z-index":(100-slideItem)});
				if(this.options.slideType!==1&&slideItem!==this.currentElement){
					navigationItem.setStyle("opacity",0);
					}
				this.elements[slideItem]["fx"]=new Fx.Styles(navigationItem,{wait:false,duration:this.options.duration});
				if(slideItem!==this.currentElement){
					this.elements[slideItem]["fx"].set(this.firstRun);
					}
				navigationItem.addEvent("mouseover",function(C){
					if($defined(this.period)){
						$clear(this.period)}}.bind(this));
						navigationItem.addEvent("mouseout",function(C){
							if(this.options.autoslide==0){
							  this.period=this.rotateSlides.periodical(this.options.slideTime,this);
							  }
							 }.bind(this)
							)}.bind(this));
								if(!this.options.tooltips){
									new Tips($$(".dabnews_link"),{className:"dabnews_tips"});
									}
								if(!this.options.autoslide){
									this.period=this.rotateSlides.periodical(this.options.slideTime,this);
									}
								this.setNavigation();
								if(this.options.navLinks){
									this.secondNavigation();
									$(this.options.navigation.container).addEvent("mousewheel",function(navigationItem){
										navigationItem=new Event(navigationItem);
										navigationItem.stop();
										var slideItem=this.currentElement-navigationItem.wheel;
										if(navigationItem.wheel>0&&slideItem<0){A=this.navElements.length-1;}
										if(navigationItem.wheel<0&&slideItem>this.navElements.length-1){slideItem=0;}
										this.resetAutoslide();
										this.period=this.rotateSlides.bind(this).periodical(this.options.autoSlide);
										this.nextSlide(slideItem);
										}.bind(this))
									}
								},rotateSlides:function(){
									var slideItem=this.currentElement+this.direction;
									if(slideItem<0){slideItem=this.elements.length-1;}
									if(slideItem>this.elements.length-1){slideItem=0;}
									this.nextSlide(slideItem);
									},nextSlide:function(slideItem){
										if(slideItem==this.currentElement){return;}
										this.elements[this.currentElement]["fx"].start(this.hideEffect);
										this.elements[slideItem]["fx"].start(this.showEffect);
										this.currentElement=slideItem;
										if($(this.options.navInfo)){
											$(this.options.navInfo).setHTML("Link "+(slideItem+1)+" of "+this.elements.length);
											}
										if($defined(this.navElements)){
											this.navElements.removeClass("selected");
											this.navElements[slideItem].addClass("selected");
											var navigationItem=slideItem-this.correction<0?0:slideItem-this.correction;
										if(navigationItem+this.correction>=this.navElements.length-this.correction){
											navigationItem=(this.navElements.length-1)-this.correction*2;
											}
										this.navScroll.toElement(this.navElements[navigationItem])
									}
								},setNavigation:function(){
								  if(!$(this.options.navigation.forward)){return}
									$(this.options.navigation.forward).addEvent("click",function(slideItem){
									new Event(slideItem).stop();
									this.direction=1;this.resetAutoslide();
									this.rotateSlides()}.bind(this));
									$(this.options.navigation.back).addEvent("click",function(slideItem){
										new Event(slideItem).stop();
										this.direction=-1;
										this.resetAutoslide();
										this.rotateSlides();
										}.bind(this))
									},resetAutoslide:function(){
										if($defined(this.period)){
										$clear(this.period);
										this.period=this.rotateSlides.periodical(this.options.slideTime,this);
										}
									},secondNavigation:function(){
									  this.navElements=$$(this.options.navLinks);
									  this.navElements.each(function(navigationItem,slideItem){
									    if(slideItem==this.currentElement){
										  this.navScroll.toElement(navigationItem);
											navigationItem.addClass("selected")}navigationItem.addEvent("click",function(C){
												new Event(C).stop();
												this.resetAutoslide();
												this.nextSlide(slideItem);
												}.bind(this)
											)}.bind(this)
										);
										if(!this.options.tooltips){
											new Tips(this.navElements,{className:"dabnews_tips"});
											}
										}
									});
