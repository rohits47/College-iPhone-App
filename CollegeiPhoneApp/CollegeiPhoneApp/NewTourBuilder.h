//
//  NewTourBuilder.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 8/1/11.
//  Copyright 2011 Student. All rights reserved.
//
// Not even sure if this class is necesary but it seems that there'll be enough components involved in building a tour to justify its own class

#import <Foundation/Foundation.h>

@interface NewTourBuilder : NSObject {
	// instance vars
	UIWindow *myCollegesWindow;
    UITableView *myCollegesTable;
    UIWindow *collegeDatabaseWindow;
    UITableView *collegeDatabaseTable;
    UINavigationBar *collegeNavBar;
	UITabBar *tabBar;
    UITabBarItem *colleges;
    UITabBarItem *profile;
    UITabBarItem *application;
    UITabBarItem *plans;
}

// methods

- (/*type goes here but I'm not sure what type to put, will determine it later*/) addCollegeToTour; // to display tours already inputted

@end
