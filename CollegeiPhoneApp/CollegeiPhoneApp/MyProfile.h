//
//  MyProfile.h
//  CollegeiPhoneApp
//
//  Created by Rohit Sanbhadti on 7/30/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface MyProfile : NSObject {
	// instance vars // will need to be updated in accordance with GUI
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

- (/*type goes here but I'm not sure what type to put, will determine it later*/) connectToCounselor; // shows the new page to enter the link code
- (/*type goes here but I'm not sure what type to put, will determine it later*/) connectToFacebook; // uses fb apis, will need to look more into how those apis work and how we want user to connect to fb

@end
