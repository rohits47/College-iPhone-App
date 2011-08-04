//
//  CollegeSocialAppDelegate.h
//  CollegeSocial
//
//  Created by Abhinav  Khanna on 8/2/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface CollegeSocialAppDelegate : NSObject <UIApplicationDelegate> {
     UIWindow *window;
     UITabBarController *tabBarController;
}

@property (nonatomic, retain) IBOutlet UIWindow *window;
@property (nonatomic, retain) IBOutlet UITabBarController *tabBarController;

@end
