//
//  LocalStorageController.h
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface LocalStorageController : NSObject {
	NSString *theString;
	NSMutableArray *theArray;
}

@property (copy, nonatomic) NSString *theString;
@property (retain, nonatomic) NSMutableArray *theArray;

- (void) writeToDatabase;
- (void) readFromDatabase;

@end
