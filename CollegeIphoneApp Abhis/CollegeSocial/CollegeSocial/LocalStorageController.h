//
//  LocalStorageController.h
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Student. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface LocalStorageController : NSObject

- (id) readFromDatabase:(NSString*)keyToRead isArray:(BOOL)array plistName:(NSString*)nameOfPlist;
- (void) writeToDatabase:(NSString*)key keyValues:(NSArray*)values plistName:(NSString*)nameOfPlist;

@end