//
//  VisitedColleges.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 8/1/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface VisitedColleges : NSObject {
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

- (/*type goes here but I'm not sure what type to put, will determine it later*/) setCollegeAsVisited; // to be called from college Tours after a tour is "finished"

@end
