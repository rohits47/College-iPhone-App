//
//  LocalStorageController.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import "LocalStorageController.h"

@implementation LocalStorageController

@synthesize string;
@synthesize array;

- (id)init
{
    self = [super init];
    if (self) {
        // Initialization code here.
    }
    
    return self;
}

// this method is unfinished, and currently unsusable: this is templates code
- (void) writeToDatabase
{
	NSString *error;
    NSString *rootPath = [NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) objectAtIndex:0];
    NSString *plistPath = [rootPath stringByAppendingPathComponent:@"Data.plist"];
    NSDictionary *plistDict = [NSDictionary dictionaryWithObjects:
							   [NSArray arrayWithObjects: string, array, nil]
														  forKeys:[NSArray arrayWithObjects: @"Name", @"Phones", nil]];
    NSData *plistData = [NSPropertyListSerialization dataFromPropertyList:plistDict
																   format:NSPropertyListXMLFormat_v1_0
														 errorDescription:&error];
    if(plistData)
	{
		[plistData writeToFile:plistPath atomically:YES];
    }
    else
	{
		NSLog(error);
		[error release];
    }
    //return NSTerminateNow;
}

@end
