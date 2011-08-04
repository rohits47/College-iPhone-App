//
//  MyApplication.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 8/1/11.
//  Copyright 2011 Student. All rights reserved.
//
// This class will include the views for the questions and answers for the applications, and associated code

#import <Foundation/Foundation.h>

@interface MyApplication : NSObject {
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




@end
