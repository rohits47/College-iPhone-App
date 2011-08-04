//
//  NotifCenter.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 7/30/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface NotifCenter : NSObject {
	// instance vars // will need to be updated based on GUI, these are placeholders for now
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



@end
