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

- (/*type goes here but I'm not sure what type to put, will determine it later*/) fetchNewNotifications;
// not sure what other methods are necessary...seems like the notif center should just do a fetch whenever the user opens app/if push notifs are enabled, then on a regular interval

@end
