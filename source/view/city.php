<?php

/**
 * @var City $city
 * @var Building_Interface[] $buildingsDeprecated
 * @var array $resources
 * @var array $buildings
 */

JavaScript::getInstance()->bind('mwoApp.retrieve("cityViewModel")();');


echo "
<div id='city' ng-controller='CityCtrl' ng-init='setup({$city->id()}, {$resources}, {$buildings})'>
	<div class='buildings' ng-repeat='building in buildings'>
		<div class='building'>
			<span>{{building.name}}</span>
			<span>{{building.level}}</span>
			<span class='icon'>
				<span ng-class='{
					ready: \"entypo-flag\",
					waiting: \"entypo-dot-3\",
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
				<table>
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
								<span class=''>{{resourceAvailable(resource.key)}}</span> /
								{{resource.amountRequired}}
								{{resource.name}}
							</div>
							<div ng-hide='ware.required'>-</div>
						</td>
						<td>
							<a href='javascript:;'
								ng-class='{button: true, disabled: (!ware.canProduce || currentBuilding.isWorking)}'
								ng-click='produce(ware)'>
								{{ware.productionTypeName}}
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>";