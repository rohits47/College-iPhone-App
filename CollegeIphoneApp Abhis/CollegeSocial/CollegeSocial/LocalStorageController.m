//
//  LocalStorageController.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

#import "LocalStorageController.h"

@implementation LocalStorageController

@synthesize theString;
@synthesize theArray;

- (id)init
{
    self = [super init];
    if (self) {
        // Initialization code here.
    }
    
    return self;
}

- (void) readFromDatabase
{
	NSString *error = nil;
	NSPropertyListFormat format;
	NSString *plistPath;
	NSString *rootPath = [NSSearchPathForDirectoriesInDomains(NSDocumentDirectory,
															  NSUserDomainMask, YES) objectAtIndex:0];
	plistPath = [rootPath stringByAppendingPathComponent:@"Data.plist"];
	if (![[NSFileManager defaultManager] fileExistsAtPath:plistPath])
		{
		plistPath = [[NSBundle mainBundle] pathForResource:@"Data" ofType:@"plist"];
		}
	NSData *plistXML = [[NSFileManager defaultManager] contentsAtPath:plistPath];
	NSDictionary *temp = (NSDictionary *)[NSPropertyListSerialization
										  propertyListFromData:plistXML
										  mutabilityOption:NSPropertyListMutableContainersAndLeaves
										  format:&format
										  errorDescription:&error];
	if (!temp)
		{
		NSLog(@"Error reading plist: %@, format: %d", error, format);
		}
	self.theString = [temp objectForKey:@"String"];
	self.theArray = [NSMutableArray arrayWithArray:[temp objectForKey:@"Array"]];
}

// this method is unfinished, and currently unsusable: this is templates code
- (void) writeToDatabase
{
	NSString *error;
    NSString *rootPath = [NSSearchPathForDirectoriesInDomains(NSDocumentDirectory, NSUserDomainMask, YES) objectAtIndex:0];
    NSString *plistPath = [rootPath stringByAppendingPathComponent:@"Data.plist"];
    NSDictionary *plistDict = [NSDictionary dictionaryWithObjects:
							   [NSArray arrayWithObjects: theString, theArray, nil]
														  forKeys:[NSArray arrayWithObjects: @"String", @"Array", nil]];
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
