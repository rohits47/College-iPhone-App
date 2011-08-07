//
//  DBFetcher.h
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/3/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "SBJson.h" // allows JSON parsing

@interface ServerController : NSObject

- (NSArray*) fetchProfileData: (int)studentID;

- (NSArray*) fetchCollegeNamesList;

- (NSArray*) fetchMyCollegesList:(int)studentID;

- (NSArray*) fetchMyRecommendedColleges:(int)studentID;

/*
 - (NSString*) fetchCollegeData: (int) collegeID; // data used in college detail view
 
 - (NSString*) fetchNewNotifications; // data used in notification center
 
 - (NSString*) fetchNewRecommended; // should check with the notif center for new recommended colleges
 
 - (void) parseJson:(NSString*) jsonString; // used to parse json from api, prepare for further formatting
 */
@end
