//
//  LocalStorageController.h
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface LocalStorageController : NSObject {
	NSString *string;
	NSMutableArray *array;
}

@property (copy, nonatomic) NSString *string;
@property (retain, nonatomic) NSMutableArray *array;

- (void) writeToDatabase;

@end