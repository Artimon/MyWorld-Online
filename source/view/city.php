<?php

/**
 * @var City $city
 * @var Building_Interface[] $buildingsDeprecated
 * @var array $resources
 * @var array $buildings
 */

echo "
<div id='city' ng-controller='CityCtrl' ng-init='setup({$city->id()}, {$resources}, {$buildings})'>
	<ul class='resources'>
		<li ng-repeat='resource in resources'>
			{{resource.amountAvailable}}
			{{resource.name}}
		</li>
	</ul>
	<div class='clear'></div>

	<div class='buildings'>
		<div class='building' ng-repeat='building in buildings'>
			<span>{{building.name}}</span>
			<span>{{building.level}}</span>
			<span class='icon'>
				<span ng-class='{
					ready: \"entypo-flag\",
					waiting: \"entypo-dot-3\",
					upgrading: \"entypo-up-open-big\",
					clear: \"\",
					working: \"\"
				}[building.state]'></span>
			</span>
			<a href='javascript:;' ng-click='buildingInteract(building)'>action</a>
		</div>
	</div>

	<div id='cityContentBox' class='null'>
		<div class='box'>
			<h3 class='head'>
				{{contentBoxTitle}}
				<a href='javascript:;' class='entypo-cancel' ng-click='contentBox.close()'></a>
			</h3>
			<div class='body'>
				<table ng-hide='isConstructionSite'>
					<tr ng-repeat='ware in goods'>
						<td>{{ware.name}}</td>
						<td>
							<span ng-hide='currentBuilding.isWorking'>
								{{ware.productionDuration|duration}}
							</span>
							<span ng-show='currentBuilding.isWorking'>
								{{ware.remainingTime|duration}}
							</span>
						</td>
						<td>
							<div ng-repeat='resource in ware.required' ng-show='ware.required'>
								<span class=''>{{resource.amountAvailable}}</span> /
								{{resource.amountRequired}}
								{{resource.name}}
							</div>
							<div ng-hide='ware.required'>-</div>
						</td>
						<td>
							<a href='javascript:;'
								ng-class='{button: true, disabled: (!ware.canProduce || currentBuilding.isWorking)}'
								ng-click='produce(ware, \$event)'>
								{{ware.productionTypeName}}
							</a>
						</td>
					</tr>
				</table>
				<table ng-show='isConstructionSite'>
					<tr ng-repeat='building in buildable'>
						<td>{{building.name}}</td>
						<td>
							<ul class='resources'>
								<li ng-repeat='resource in building.requires'
									ng-class='{insufficient: (resource.amountRequired > resource.amountAvailable)}'>
									{{resource.amountAvailable}} /
									{{resource.amountRequired}}
									{{resource.name}}
								</li>
							</ul>
							<div class='clear'></div>
						</td>
						<td>
							<a href='javascript:;'
								ng-click='buildingBuild(building.key)'
								ng-class='{button: true, disabled: !building.canBuild}'>
								{{building.buildTypeName}}
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>";