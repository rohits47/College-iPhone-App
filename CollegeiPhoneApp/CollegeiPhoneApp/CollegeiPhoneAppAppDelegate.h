#import <UIKit/UIKit.h>

@interface CollegeiPhoneAppAppDelegate : NSObject <UIApplicationDelegate> {
    UIWindow *myCollegesWindow;
    UITableView *myCollegesTable;
    UIWindow *collegeDatabaseWindow;
    UITableView *collegeDatabaseTable;
    UINavigationBar *collegeNavBar;
    UIBarButtonItem *addCollegeBarButton;
    UIBarButtonItem *myCollegesBarButton;
    UITabBar *tabBar;
    UITabBarItem *colleges;
    UITabBarItem *profile;
    UITabBarItem *application;
    UITabBarItem *plans;
}

@property (nonatomic, retain) IBOutlet UIWindow *myCollegesWindow;
@property (nonatomic, retain) IBOutlet UITableView *myCollegesTable;
@property (nonatomic, retain) IBOutlet UIWindow *collegeDatabaseWindow;
@property (nonatomic, retain) IBOutlet UITableView *collegeDatabaseTable;
@property (nonatomic, retain) IBOutlet UINavigationBar *collegeNavBar;
@property (nonatomic, retain) IBOutlet UIBarButtonItem *addCollegeBarButton;
@property (nonatomic, retain) IBOutlet UIBarButtonItem *myCollegesBarButton;
@property (nonatomic, retain) IBOutlet UITabBar *tabBar;
@property (nonatomic, retain) IBOutlet UITabBarItem *colleges;
@property (nonatomic, retain) IBOutlet UITabBarItem *profile;
@property (nonatomic, retain) IBOutlet UITabBarItem *application;
@property (nonatomic, retain) IBOutlet UITabBarItem *plans;

- (IBAction) addCollegeBarButtonPressed;
- (IBAction) myCollegesBarButtonPressed;

@end
