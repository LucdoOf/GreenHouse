<?php

use GreenHouse\Controllers\ConfigurationController;
use GreenHouse\Controllers\DevicesController;
use GreenHouse\Controllers\HousesController;
use GreenHouse\Controllers\FlatsController;
use GreenHouse\Controllers\LoginController;
use GreenHouse\Controllers\RoomsController;

return [
    'login'                                             => ["GET", "/login", [LoginController::class, "login"]],
    'signup'                                            => ["GET", "/signup", [LoginController::class, "signup"]],
    'signup.post'                                       => ["POST", "/signup/post", [LoginController::class, "signupPost"]],
    'houses'                                            => ["GET", "", [HousesController::class, "listHouses"]],
    'house.create'                                      => ["POST", "/house/create/post", [HousesController::class, "createHouse"]],
    'house.create.page'                                 => ["GET", "/house/create", [HousesController::class, "createPage"]],
    'house.delete'                                      => ["GET", "/houses/delete/(.+)", [HousesController::class, "deleteHouse"]],
    'house.edit'                                        => ["POST", "/houses/edit/(.+)", [HousesController::class, "editHouse"]],
    'house'                                             => ["GET", "/houses/(.+)", [HousesController::class, "houseDetails"]],
    'flats'                                             => ["GET", "/flats", [FlatsController::class, "listFlats"]],
    'flat.create'                                       => ["POST", "/flat/create/post", [FlatsController::class, "createFlat"]],
    'flat.create.page'                                  => ["GET", "/flat/create", [FlatsController::class, "createPage"]],
    'flat.add-lodger.post'                              => ["POST", "/flat/(.+)/add-lodger/post", [FlatsController::class, "addLodgerPost"]],
    'flat.add-lodger'                                   => ["GET", "/flat/(.+)/add-lodger", [FlatsController::class, "addLodger"]],
    'flat.add-room.post'                                => ["POST", "/flat/(.+)/add-room/post", [FlatsController::class, "addRoomPost"]],
    'flat.add-room'                                     => ["GET", "/flat/(.+)/add-room", [FlatsController::class, "addRoom"]],
    'flat.delete'                                       => ["GET", "/flats/delete/(.+)", [FlatsController::class, "deleteFlat"]],
    'flat.edit'                                         => ["POST", "/flat/edit/(.+)", [FlatsController::class, "editFlat"]],
    'flat'                                              => ["GET", "/flat/(.+)", [FlatsController::class, "flatDetails"]],
    'room.edit'                                         => ["POST", "/room/edit/(.+)", [RoomsController::class, "editRoom"]],
    'room'                                              => ["GET", "/room/(.+)", [RoomsController::class, "roomDetails"]],
    'auth'                                              => ["POST", "/auth", [LoginController::class, "auth"]],
    'test'                                              => ["GET", "/test/(.+)/test/(.+)", [LoginController::class, "test"]],
    'logout'                                            => ["GET", "/logout", [LoginController::class, "logout"]],
    'configuration'                                     => ["GET", "/configuration", [ConfigurationController::class, "configuration"]],
    'configuration.flat-types.create'                   => ["POST", "/configuration/flat-types/create", [ConfigurationController::class, "createFlatType"]],
    'configuration.room-types.create'                   => ["POST", "/configuration/room-types/create", [ConfigurationController::class, "createRoomType"]],
    'configuration.flat-types.room-types.link'          => ["POST", "/configuration/flat-types/(.+)/room-types/link", [ConfigurationController::class, "linkRoomType"]],
    'configuration.device-types.create'                 => ["POST", "/configuration/device-types/create", [ConfigurationController::class, "createDeviceType"]],
    'configuration.regions.create'                      => ["POST", "/configuration/zones/regions/create", [ConfigurationController::class, "createRegion"]],
    'configuration.departments.create'                  => ["POST", "/configuration/zones/regions/(.+)/departments/create", [ConfigurationController::class, "createDepartment"]],
    'configuration.cities.create'                       => ["POST", "/configuration/zones/departments/(.+)/cities/create", [ConfigurationController::class, "createCity"]],
    'devices'                                           => ["GET", "/devices", [DevicesController::class, "listDevices"]],
    'device.create'                                     => ["POST", "/device/create/post", [DevicesController::class, "createDevice"]],
    'device.create.page'                                => ["GET", "/device/create", [DevicesController::class, "createPage"]],
    'device.delete'                                     => ["GET", "/devices/delete/(.+)", [DevicesController::class, "deleteDevice"]],
    'device.edit'                                       => ["POST", "/devices/edit/(.+)", [DevicesController::class, "editDevice"]],
    'device.measures.create'                            => ["POST", "/devices/(.+)/measures/create", [DevicesController::class, "createMeasure"]],
    'device'                                            => ["GET", "/devices/(.+)", [DevicesController::class, "deviceDetails"]],
    'configuration.substances.create'                   => ["GET", "/configuration/substances/create", [ConfigurationController::class, "createSubstance"]],
    'configuration.resources.create'                    => ["GET", "/configuration/resources/create", [ConfigurationController::class, "createResource"]],
    'configuration.substances.create.post'              => ["POST", "/configuration/substances/create/post", [ConfigurationController::class, "createSubstancePost"]],
    'configuration.resources.create.post'               => ["POST", "/configuration/resources/create/post", [ConfigurationController::class, "createResourcePost"]],
    'configuration.device-types.resources.link'         => ["GET", "/configuration/device-types/(.+)/resources/link", [ConfigurationController::class, "linkResource"]],
    'configuration.device-types.resources.link.post'    => ["POST", "/configuration/device-types/(.+)/resources/link/post", [ConfigurationController::class, "linkResourcePost"]],
    'configuration.device-types.substances.link'        => ["GET", "/configuration/device-types/(.+)/substances/link", [ConfigurationController::class, "linkSubstance"]],
    'configuration.device-types.substances.link.post'   => ["POST", "/configuration/device-types/(.+)/substances/link/post", [ConfigurationController::class, "linkSubstancePost"]],
    'configuration.device-type'                         => ["GET", "/configuration/device-types/(.+)", [ConfigurationController::class, "deviceTypeDetails"]],
];
