//
//  CollegeTours.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 7/30/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface CollegeTours : NSObject {
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

- (/*type goes here but I'm not sure what type to put, will determine it later*/) fetchAllTours; // to display all tours already inputted
- (/*type goes here but I'm not sure what type to put, will determine it later*/) fetchSpecificTour: (int) tourID; // to display a specific tour, indicated with parameter
- (/*type goes here but I'm not sure what type to put, will determine it later*/) makeNewTour; // sends new tour data to server for entry into database
- (/*type goes here but I'm not sure what type to put, will determine it later*/) setTourAsFinished: (int) tourID; // calls VisitedColleges method "setCollegeAsVisited" for all colleges withing selected tour

@end
