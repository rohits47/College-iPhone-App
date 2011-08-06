//
//  LocalStorageController.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/4/11.
//  Copyright 2011 Student. All rights reserved.
//

#import "LocalStorageController.h"

@implementation LocalStorageController

- (id)init
{
    self = [super init];
    if (self) {
        // Initialization code here.
    }
    
    return self;
}

- (id) readFromDatabase:(NSString*)keyToRead isArray:(BOOL)array plistName:(NSString*)nameOfPlist
{
	NSString *errorDesc = nil;
	NSPropertyListFormat format;
	NSString *plistPath = [[NSBundle mainBundle] pathForResource:nameOfPlist ofType:@"plist"];
	NSData *plistXML = [[NSFileManager defaultManager] contentsAtPath:plistPath];
	NSDictionary *dict = (NSDictionary *)[NSPropertyListSerialization
										  propertyListFromData:plistXML
										  mutabilityOption:NSPropertyListMutableContainersAndLeaves
										  format:&format
										  errorDescription:&errorDesc];
	if (!dict)
	{
		NSLog(@"Error reading plist: %@, format: %lu", errorDesc, format);
	}
	if (array)
	{
		NSArray *retVal = [dict objectForKey:keyToRead];
		return retVal;
	}
	else
	{
		NSString *retVal = [dict objectForKey:keyToRead];
		return retVal;
	}
}

// this method is unfinished, but usable
- (void) writeToDatabase:(NSString*)key keyValues:(NSArray*)values plistName:(NSString*)nameOfPlist
{
	NSMutableString *filePath = [[NSMutableString alloc] initWithString:@"/Users/Rohit/Desktop/testPRoj/testPRoj/"];
	[filePath appendString:nameOfPlist];
	NSMutableDictionary* plistDict = [[NSMutableDictionary alloc] initWithContentsOfFile:filePath];
	[plistDict setValue:values forKey:key];
	[plistDict writeToFile:filePath atomically: YES];
	/*NSString *error;
	NSString *plistPath = [[NSBundle mainBundle] pathForResource:nameOfPlist ofType:@"plist"];
    NSDictionary *plistDict = [NSDictionary dictionaryWithObjects:values forKeys:keys];
    NSData *plistData = [NSPropertyListSerialization dataFromPropertyList:plistDict
																   format:NSPropertyListXMLFormat_v1_0
														 errorDescription:&error];
    if (plistData)
	{
        [plistData writeToFile:plistPath atomically:YES];
	}
    else
	{
        NSLog(error);
        [error release];
	}*/
}

@end
