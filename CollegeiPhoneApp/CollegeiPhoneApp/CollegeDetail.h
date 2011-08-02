//
//  CollegeDetail.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 7/29/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface CollegeDetail : NSObject {
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

- (/*type goes here but I'm not sure what type to put, will determine it later*/) fetchCollegeData: (int) collegeID;
- (/*type goes here but I'm not sure what type to put, will determine it later*/) formatDataForDisplay; // Arranges the data brought by the fetch into a neat visual layout for the GUI

@end
