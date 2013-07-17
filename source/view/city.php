<?php

/**
 * @var City $city
 * @var array $resources
 * @var array $buildings
 */

$initData = "{$city->id()}, {$resources}, {$buildings}";
?>

<div id='city' ng-controller='CityCtrl' ng-init='setup(<?php echo $initData ?>)'>
	<ul class='resources'>
		<li class='resource' ng-repeat='resource in resources'>
			{{resource.amountAvailable}}
			<img ng-src='{{resource.url|image}}' title='{{resource.name}}'>
		</li>
	</ul>
	<div class='clear'></div>

	<div class='buildings'>
		<div class='building' ng-repeat='building in buildings'>
			<img ng-src='{{building.url|image}}'>
			<span>{{building.name}}</span>
			<span>{{building.level}}</span>
			<span class='icon'>
				<span ng-class='{
					ready: "entypo-flag",
					waiting: "entypo-dot-3",
					upgrading: "entypo-up-open-big",
					clear: "",
					working: ""
				}[building.state]'></span>
			</span>
			<a href='javascript:;' ng-click='buildingInteract(building)'>action</a>
			<div class='stars' ng-class='{
				0: "none",
				1: "none",
				2: "one",
				3: "two",
				4: "three"
			}[building.level]'></div>
		</div>
	</div>

	<div id='cityContentBox' class='null'>
		<div class='box'>
			<h3 class='head'>
				{{contentBoxTitle|i18n}}
				<a href='javascript:;' class='entypo-cancel'
					title='{{"close"|i18n}}' ng-click='contentBox.close()'></a>
			</h3>
			<div class='body'>

				<!-- Default building. -->
				<div class='building' ng-hide='isConstructionSite'>

					<!-- Upgrade building -->
					<div class='upgrade left'>
						<h4>{{'upgrade'|i18n}}</h4>
						<div class='stars' ng-class='{
							1: "none",
							2: "one",
							3: "two",
							4: "three",
							5: "three"
						}[currentBuilding.level + 1]'></div>
						<p>{{'cost'|i18n}}</p>

						<ul class='resources'>
							<li class='resource'
								ng-repeat='resource in currentBuilding.requires'
								ng-class='{insufficient: resource.insufficient }'>
								{{resource.amountAvailable}} /
								{{resource.amountRequired}}
								<img ng-src='{{resource.url|image}}'
									title='{{resource.name}}'>
							</li>
						</ul>
						<div class='clear'></div>

						<a class='button small entypo-up-open-big' href='javascript:;'
							ng-click='upgrade($event)'
							ng-class='{ disabled: !currentBuilding.canBuild }'></a>
					</div>

					<!-- Building production list. -->
					<table class='left'>
						<tr ng-repeat='ware in goods'>
							<td class='resource'>
								{{ware.productionAmount}}
								<img ng-src='{{ware.url|image}}' title='{{ware.name}}'>
							</td>
							<td>
								<span ng-hide='currentBuilding.isWorking'>
									{{ware.productionDuration|duration}}
								</span>
								<span ng-show='currentBuilding.isWorking'>
									{{ware.remainingTime|duration}}
								</span>
							</td>
							<td>
								<ul class='resources' ng-show='ware.requires'>
									<li class='resource'
										ng-repeat='resource in ware.requires'
										ng-class='{insufficient: resource.insufficient }'>
										{{resource.amountAvailable}} /
										{{resource.amountRequired}}
										<img ng-src='{{resource.url|image}}'
											title='{{resource.name}}'>
									</li>
								</ul>

								<div ng-hide='ware.requires'>-</div>
							</td>
							<td>
								<a href='javascript:;'
									ng-class='{ button: true, disabled: !ware.canProduce }'
									ng-click='produce(ware, $event)'>
									{{ware.productionTypeName}}
								</a>
							</td>
						</tr>
					</table>
					<div class='clear'></div>
				</div>

				<!-- Create building list. -->
				<table ng-show='isConstructionSite'>
					<tr ng-repeat='building in buildable'>
						<td>{{building.name}}</td>
						<td>
							<ul class='resources'>
								<li class='resource'
									ng-repeat='resource in building.requires'
									ng-class='{insufficient: resource.insufficient }'>
									{{resource.amountAvailable}} /
									{{resource.amountRequired}}
									<img ng-src='{{resource.url|image}}'
										title='{{resource.name}}'>
								</li>
							</ul>
							<div class='clear'></div>
						</td>
						<td>
							<a href='javascript:;' class='button'
								ng-click='build(building.key, building.canBuild)'
								ng-class='{ disabled: !building.canBuild }'>
								{{building.buildTypeName}}
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>